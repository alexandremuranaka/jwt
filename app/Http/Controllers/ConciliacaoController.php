<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use View;
use DB;
use Excel;
use Illuminate\Support\Facades\Mail;
use App\Mail\RelatorioPendencias;
use Session;
use Auth;


class ConciliacaoController extends Controller
{
  /*
    private $hospital_id;
    private $hospital_name;
    private $user_id;
    private $user_name;
*/


    public function hospitals()
    {
        $Hospitals = \App\Hospital::orderBy('name')->get();
        return view('dashboard.bymedspay.hospital',compact('Hospitals'));
    }


    public function index()
    {

        $hospital_id = session::get('hospital_id');
        $user_id = Auth::user()->id;

        if($hospital_id)
        {
            /**
                Carregar total de lançamentos pendentes
                Carregar total conciliado
            */
            $qtdPendentes = DB::table('registers')
            ->join('procedures','registers.id','=','procedures.register_number')
            ->where('registers.user_id','=', $user_id)
            ->where('registers.hospital_id','=', $hospital_id)
            ->whereNull('procedures.payment_item_id')
            ->select(DB::raw('count(procedures.id) as qtd'))
            ->first();


            $valorConciliado = DB::table('payments')
            ->join('payment_items','payments.id','=','payment_items.payment_id')
            ->join('procedures','procedures.payment_item_id','=','payment_items.id')
            ->where('payments.user_id','=', $user_id)
            ->where('payments.hospital_id','=', $hospital_id)
            ->select(DB::raw('sum(payment_items.value) as total'))
            ->first();

            $valorTotal = DB::table('payments')
            ->join('payment_items','payments.id','=','payment_items.payment_id')
            ->where('payments.user_id','=',$user_id)
            ->where('payments.hospital_id','=',$hospital_id)
            ->select(DB::raw('sum(payment_items.value) as total'))
            ->first();

            /**
                Relatório dashboard - 3 meses

                - Procedimentos totais
                - Conciliados
                - Pendentes
                - Valor recebido
            */
            $date = new \DateTime();
            for($i=2;$i>=0;$i--)
            {
                $di = $date->format('Y-m-01');
                $df = $date->format('Y-m-t');

                // Procedimentos totais
                $qtdTotal = DB::table('registers')
            ->join('procedures','registers.id','=','procedures.register_number')
            ->where('registers.user_id','=', $user_id)
            ->where('registers.hospital_id','=', $hospital_id)
            ->whereBetween('procedures.date',[$di,$df])
            ->select(DB::raw('count(procedures.id) as qtd'))
            ->first();
                $qtdConciliado = DB::table('registers')
            ->join('procedures','registers.id','=','procedures.register_number')
            ->where('registers.user_id','=',$user_id)
            ->where('registers.hospital_id','=',$hospital_id)
            ->where('procedures.payment_item_id','>',0)
            ->whereBetween('procedures.date',[$di,$df])
            ->select(DB::raw('count(procedures.id) as qtd'))
            ->first();
                $totalConciliado = DB::table('payments')
            ->join('payment_items','payments.id','=','payment_items.payment_id')
            ->join('procedures','procedures.payment_item_id','=','payment_items.id')
            ->where('payments.user_id','=',$user_id)
            ->where('payments.hospital_id','=',$hospital_id)
            ->whereBetween('procedures.date',[$di,$df])
            ->select(DB::raw('sum(payment_items.value) as total'))
            ->first();
                // Recebimentos clinico
                $recebimentoClinico = DB::table('payments')
            ->join('payment_items','payments.id','=','payment_items.payment_id')
            ->where('payments.user_id','=',$user_id)
            ->where('payments.hospital_id','=',$hospital_id)
            ->whereBetween('payment_items.date',[$di,$df])
            ->where('tuss','=',10102019)
            ->select(DB::raw('sum(payment_items.value) as total'))
            ->first();

                // Recebimentos cirurgico
                $recebimentoCirurgico = DB::table('payments')
            ->join('payment_items','payments.id','=','payment_items.payment_id')
            ->where('payments.user_id','=',$user_id)
            ->where('payments.hospital_id','=',$hospital_id)
            ->whereBetween('payment_items.date',[$di,$df])
            ->where('tuss','<>',10102019)
            ->select(DB::raw('sum(payment_items.value) as total'))
            ->first();

            $arrTotal[$i]['periodo']=$date->format('m/Y');
            $arrTotal[$i]['procedimentos']=$qtdTotal->qtd;
            $arrTotal[$i]['conciliados']=$qtdConciliado->qtd;
            $arrTotal[$i]['total']=$totalConciliado->total;
            $arrTotal[$i]['clinico']=$recebimentoClinico->total;
            $arrTotal[$i]['cirurgico']=$recebimentoCirurgico->total;

                $date->sub(new \DateInterval('P1M'));
            }

            return view('dashboard.bymedspay.conciliacao.home',compact('qtdPendentes','valorConciliado','valorTotal','arrTotal'));
        }
        else
        {
            return redirect('/dashboard/bymedspay/conciliacao/hospitals');
        }
    }

    public function pendentes()
    {
        /**
            Existe registros pendentes de conciliação
        */
        $hospital_id = session::get('hospital_id');
        if($hospital_id)
        {
            $Procedures = DB::table('registers')
            ->join('procedures','registers.id','=','procedures.register_number')
            ->join('tuss','procedures.tuss_id','=','tuss.id')
            ->where('registers.user_id','=',$user_id)
            ->where('registers.hospital_id','=',$hospital_id)
            ->whereNull('procedures.payment_item_id')
            ->select(['registers.reference as reference','registers.name as name','registers.insurer as insurer','procedures.date as date', 'procedures.created_at as created_at','tuss.description as tuss_description','tuss.id as tuss_id'])->get();
            return view('dashboard.bymedspay.conciliacao.pendentes',compact('Procedures'));
        }
        else
        {
            return redirect('/dashboard/bymedspay/conciliacao/hospitals');
        }
    }

    public function conciliados()
    {
        /**
            Existe registros pendentes de conciliação
        */

          $hospital_id = session::get('hospital_id');
          if($hospital_id)
          {
            $Procedures = DB::table('registers')
            ->join('procedures','registers.id','=','procedures.register_number')
            ->join('tuss','procedures.tuss_id','=','tuss.id')
            ->join('payment_items','payment_items.id','=','procedures.payment_item_id')
            ->where('registers.user_id','=',$user_id)
            ->where('registers.hospital_id','=',$hospital_id)
            ->whereNotNull('procedures.payment_item_id')
            ->select(['payment_items.value as value','registers.reference as reference','registers.name as name','registers.insurer as insurer','procedures.date as date', 'procedures.created_at as created_at','tuss.description as tuss_description','tuss.id as tuss_id'])->get();
            return view('dashboard.bymedspay.conciliacao.conciliados',compact('Procedures'));
        }
        else
        {
            return redirect('/dashboard/bymedspay/conciliacao/hospitals');
        }
    }


    public function naoIdentificados()
    {
        /**
            Existe registros pendentes de conciliação
        */

        $hospital_id = session::get('hospital_id');
        if($hospital_id)
        {
            $Items = DB::table('payment_items')
            ->join('payments','payment_items.payment_id','=','payments.id')
            ->where('payments.user_id','=',$user_id)
            ->where('payments.hospital_id','=',$hospital_id)
            ->whereNull('payment_items.conciliado_at')
            ->select(['payment_items.*'])->get();

            // Listar procedimentos não conciliados
            $Procedures = \App\Procedure::with('register')->whereNull('payment_item_id')->get();

            return view('dashboard.bymedspay.conciliacao.nao_conciliados',compact('Items','Procedures'));
        }
        else
        {
            return redirect('/dashboard/bymedspay/conciliacao/hospitals');
        }
    }

    public function postPlanilha()
    {

        // Identificar módulo do hospital
        $Hospital = \App\Hospital::findOrFail($hospital_id);

        switch($Hospital->method)
        {
            case 'sao_camilo':
                return $resultado = $this->planilhaSaoCamilo();
            break;
            default:
                return back()->with('msgType','warning')->with('msgBody','Modelo de planilha incompatível.');
        }
    }

    private function planilhaSaoCamilo()
    {

        if($user_id<0)
        {
            session()->flush;
            Auth::logout();
            return redirect('dashboard');
        }

        if($hospital_id<0)
        {
            return ('/dashboard/bymedspay/conciliacao/hospitals');
        }

        Excel::load($_FILES['planilha']['tmp_name'], function($reader) use (& $to_return) {

            // Getting all results
            $results = $reader->toArray();
            //var_dump($results);exit;

            $key = time();
            foreach($results as $result)
            {
                $key .= intval($result['atend.']);
            }

            $signature = md5($key);

            $SpredsheetExists = \App\Payment::where('hash','=',$signature)->first();
            if($SpredsheetExists)
            {
                $to_return = redirect('/dashboard/bymedspay/conciliacao/planilha/'.$SpredsheetExists->id);
                //return true;
            }

            $Spredsheet = new \App\Payment();
            $Spredsheet->hash = $signature;
            $Spredsheet->filename = $_FILES['planilha']['name'];
            $Spredsheet->user_id = $this->user_id;
            $Spredsheet->hospital_id = $this->$hospital_id;
            $Spredsheet->save();

            // Lançar itens
            foreach($results as $result)
            {

                if($result['atend.'])
                {
                    $SpredsheetItem = new \App\PaymentItem();
                    $SpredsheetItem->register=intval($result['atend.']);
                    $SpredsheetItem->date=$result['data']->toDateString();
                    $SpredsheetItem->description=$result['procedimento'].' '.$result['atividade'];
                    $SpredsheetItem->insurer=$result['convenio'];
                    $SpredsheetItem->tuss=intval($result['cod.']);
                    $SpredsheetItem->qtd=intval($result['quant.']);
                    $SpredsheetItem->value=$result['vl._repasse'];
                    $SpredsheetItem->payment_id=$Spredsheet->id;
                    $SpredsheetItem->save();
                }
            }

            $to_return = redirect('/dashboard/bymedspay/conciliacao/planilha/'.$Spredsheet->id);
        });
        return $to_return;
    }

    public function pendenteEmail(Request $request)
    {


        $hospital_id = session::get('hospital_id');
        if($hospital_id)
        {
            $Procedures = DB::table('registers')
            ->join('procedures','registers.id','=','procedures.register_number')
            ->join('tuss','procedures.tuss_id','=','tuss.id')
            ->where('registers.user_id','=',$user_id)
            ->where('registers.hospital_id','=',$hospital_id)
            ->whereNull('procedures.payment_item_id')
            ->select(['registers.reference as reference','registers.name as name','registers.insurer as insurer','procedures.date as date', 'procedures.created_at as created_at','tuss.description as tuss_description','tuss.id as tuss_id'])->get();

            // Gerar Planilha
            $vars['Procedures']=$Procedures;
            $filename = 'pendentes_'.$this->user_id.'_'.time();
            Excel::create($filename, function($excel) use($vars) {

                    $excel->sheet('Pendentes', function($sheet) use($vars) {

                        $sheet->loadView('excel.pendentes',$vars);

                    });

                })->store('xls', '../storage/data/relatorios');
            // Anexar
            Mail::to($request->get('destinatario'))->send(new RelatorioPendencias($filename,$request->get('mensagem')));
            return back();
        }
        else
        {
            return redirect('/dashboard/bymedspay/conciliacao/hospitals');
        }
    }

    public function pendenteExcel()
    {
      $hospital_id = session::get('hospital_id');
      if($hospital_id)
      {
            // Calcular 60 dias atrás

            $Procedures = DB::table('registers')
            ->join('procedures','registers.id','=','procedures.register_number')
            ->join('tuss','procedures.tuss_id','=','tuss.id')
            ->where('registers.user_id','=',$user_id)
            ->where('registers.hospital_id','=',$hospital_id)
            ->where('data','<=',date('Y-m-d H:i:s',time()-5184000))
            ->whereNull('procedures.payment_item_id')
            ->select(['registers.reference as reference','registers.name as name','registers.insurer as insurer','procedures.date as date', 'procedures.created_at as created_at','tuss.description as tuss_description','tuss.id as tuss_id'])->get();

            // Gerar Planilha
            $vars['Procedures']=$Procedures;
            $filename = 'pendentes_'.$this->user_id.'_'.time();
            Excel::create($filename, function($excel) use($vars) {

                    $excel->sheet('Pendentes', function($sheet) use($vars) {

                        $sheet->loadView('excel.pendentes',$vars);

                    });

                })->download('xls');
        }
        else
        {
            return redirect('/dashboard/bymedspay/conciliacao/hospitals');
        }
    }

    public function conciliar(Request $request)
    {
      $hospital_id = session::get('hospital_id');
      if($hospital_id)
      {
            $items = $request->get('conciliar');

            if(is_array($items))
            {
                foreach(array_keys($items) as $IT)
                {
                    if($items[$IT]>0)
                    {
                        // Carregar procedimento
                        $Procedure = \App\Procedure::whereNull('payment_item_id')->find($items[$IT]);
                        $Procedure->payment_item_id=$IT;
                        $Procedure->save();

                        // Marcar como conciliado
                        $Item = \App\PaymentItem::findOrFail($IT);
                        $Item->conciliado_at=date('Y-m-d H:i:s');
                        $Item->save();
                    }
                }
            }
        }
        return back();
    }

}
