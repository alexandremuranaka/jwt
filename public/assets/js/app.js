$(document).ready(function(){

$('.data').mask('00/00/0000');
$('.telefone').mask('(99) 99999-9999');

/* menu height */
function resizeMe()
{
	h = $(window).height();
	header = $("#header").height();
	height = h - header;
	$("#menu").css("height",height);
	$("#menu").css("marginTop",header);
	$("#wrapper").css("marginTop",header);
}
$(window).resize(function(){resizeMe();});
resizeMe();


$("#btn_menu").on("click",function(){
	$(this).toggleClass("active");
	$("#menu").toggleClass("active");
	$("#wrapper").toggleClass("active");
});

$("#menu .father h3").on("click",function(){
	$(this).toggleClass("active");
	$(this).find("i").toggleClass("active");
	$(this).siblings().stop().slideToggle();
});


pagination = 1;
$("#register_load").on("click",function(){
pagination++;
	  $.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
	      url: '/dashboard/bymedspay/register-all-pagination',
	      type: 'POST',
	      data: {page: pagination},
	      dataType: 'JSON',
	      success: function (response) {
					if(response['from'] == null )
					{
						$("#register_load").css("display","none");
					}
					else
					{

					  $.each(response['data'], function(k,v){
							register = '<div class="registro_item"><p>'+v['barcode']+' '+v['patient_name']+' ('+v['medical_insurance']+') - '+v['name']+' <a href="/dashboard/bymedspay/register/'+v['id']+'/show"><i class="fa fa-eye"></i></a><a href="/dashboard/bymedspay/register/'+v['id']+'/delete"><i class="fa fa-times"></i></a></p></div>';
	            $(register).appendTo($("#registerall"));
	          });

	      	}
	      }
	  });


});


if($("#chart_procedimento").length > 0)
{
	var ctx = document.getElementById("chart_procedimento").getContext('2d');
	var myChart = new Chart(ctx, {
	  type: 'pie',
	  data: {
	    labels: ["Cirúrgico", "Clínico"],
	    datasets: [{
	      backgroundColor: [
	        "#1c66a9",
	        "#f7c04b"
	      ],
	      data: [85, 15]
	    }]
	  }
	});

	var ctx = document.getElementById("chart_hospital").getContext('2d');
	var myChart = new Chart(ctx, {
	  type: 'pie',
	  data: {
	    labels: ["Bandeirantes", "Oswaldo Cruz", "Santa Catarina", "São Camilo - Ipiranga", "São Camilo - Pompéia", "São Camilo Santana"],
	    datasets: [{
	      backgroundColor: [
	        "#1c66a9",
	        "#f7c04b",
	        "#95a5a6",
	        "#9b59b6",
	        "#f1c40f",
	        "#2ecc71"
	      ],
	      data: [6,5,3,6,12,7]
	    }]
	  }
	});

	var ctx = document.getElementById('chart_conciliacao').getContext('2d');
	var myChart = new Chart(ctx, {
	  type: 'bar',
	  data: {
	    labels: [],
	    datasets: [{
	      label: 'Conciliados',
	      data: [15],
	      backgroundColor: "#1c66a9"
	    }, {
	      label: 'Pendentes',
	      data: [1],
	      backgroundColor: "#f7c04b"
	    }, {
	      label: 'Não Lançados',
	      data: [2],
	      backgroundColor: "#ca0000"
	    }]
	  }
	});
}


$(".sanfona h4").on("click", function(){
	$(this).siblings().slideToggle("active");
});


if( $(".select").length > 0 )
{
	$('.select').select2();
}

if( $(".listagem").length > 0 )
{
	$('.listagem').slimScroll({ height: '200px'});
}

$(".listagem .member").on("click",function(){
	$(this).siblings().removeClass("selected");
	$(this).addClass("selected");

});

$(".display_team .btn_delete").on("click", function(){
	$(this).parent().remove();
});

$(".btn_option").on("click", function(){
	$(this).parent().find(".option").toggleClass("show");
});


$(".relatorio_btn").on("click",function(){
	relatorio = $(this).attr("data-relatorio");
	$(".relatorio_btn").removeClass("active");
	$(this).addClass("active");
	$(".relatorio_view").removeClass("show");
	$("#"+relatorio+"").addClass("show");
});


if($("#agenda").length > 0)
{
	$('#agenda').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,basicWeek,basicDay'
		},
		defaultDate: '2017-05-12',
		navLinks: true, // can click day/week names to navigate views
		editable: true,
		eventLimit: true, // allow "more" link when too many events
		events: [
			{
				title: 'All Day Event',
				start: '2017-05-01'
			},
			{
				title: 'Long Event',
				start: '2017-05-07',
				end: '2017-05-10'
			},
			{
				id: 999,
				title: 'Repeating Event',
				start: '2017-05-09T16:00:00'
			},
			{
				id: 999,
				title: 'Repeating Event',
				start: '2017-05-16T16:00:00'
			},
			{
				title: 'Conference',
				start: '2017-05-11',
				end: '2017-05-13'
			},
			{
				title: 'Meeting',
				start: '2017-05-12T10:30:00',
				end: '2017-05-12T12:30:00'
			},
			{
				title: 'Lunch',
				start: '2017-05-12T12:00:00'
			},
			{
				title: 'Meeting',
				start: '2017-05-12T14:30:00'
			},
			{
				title: 'Happy Hour',
				start: '2017-05-12T17:30:00'
			},
			{
				title: 'Dinner',
				start: '2017-05-12T20:00:00'
			},
			{
				title: 'Birthday Party',
				start: '2017-05-13T07:00:00'
			},
			{
				title: 'Click for Google',
				url: 'http://google.com/',
				start: '2017-05-28'
			}
		]
	});
}

// if($("#tabela_pagar_hospital").length > 0)
// {
// 	$("#tabela_pagar_comum").DataTable();
// 	$("#tabela_pagar_hospital").DataTable();
// }

if($("#casos").length > 0)
{


 const data = [
        ['Inquiries', 300],
        ['Applicants', 200],
        ['Admits', 150],
        ['Deposits', 100],
    ];
    const options = {
        block: {
            dynamicHeight: true,
            dynamicSlope: true,
            minHeight: 15,
        },
    };

    const chart = new D3Funnel('#casos');
    chart.draw(data, options);

}











});
