/*
 * Author: SgateTeam
 * Date: 24 Ago 2017
 * Description:
 *      This is a demo file used only for the main dashboard (index.html)
 **/

$(document).ready(function() {
  
  var donut;
  var area;
  var line;
  
  //1 - Gráfico donut
  $.ajax({
    url: "admin/user_month_chart",
    contentType: 'application/json; charset=utf-8',
		dataType: 'json',
		method: 'GET',
		data: {},
		success: function( data ) {
				  donut = new Morris.Donut({
				  element: 'user-month-chart',
				  resize: true,
				  colors: ["#3c8dbc", "#f56954", "#00a65a"],
				  data: data,
				  hideHover: 'auto'
				});
		},
		error: function(e) {
			console.log(e.responseText);
		}
  });
  
  //2 - Gráfico Total usuários
    area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    data: [
      {y: '2015 Q1', socios: 2666, dependentes: 2666, usuarios: 2534},
      {y: '2015 Q2', socios: 2778, dependentes: 2294, usuarios: 2334},
      {y: '2015 Q3', socios: 4912, dependentes: 1969, usuarios: 1834},
      {y: '2015 Q4', socios: 3767, dependentes: 3597, usuarios: 2634},
      {y: '2016 Q1', socios: 6810, dependentes: 1914, usuarios: 2134},
      {y: '2016 Q2', socios: 5670, dependentes: 4293, usuarios: 4134},
      {y: '2016 Q3', socios: 4820, dependentes: 3795, usuarios: 3234},
      {y: '2016 Q4', socios: 15073, dependentes: 5967, usuarios: 4394},
      {y: '2017 Q1', socios: 10687, dependentes: 4460, usuarios: 3234},
      {y: '2017 Q2', socios: 8432, dependentes: 5713, usuarios: 4234}
    ],
    xkey: 'y',
    ykeys: ['socios', 'dependentes', 'usuarios'],
    labels: ['Sócios', 'Dependentes', 'Usuários'],
    lineColors: ['#a0d0e0', '#3c8dbc', '#419EDE'],
    hideHover: 'auto'
  });
  
  //3 - Gráfico
    line = new Morris.Line({
    element: 'line-chart',
    resize: true,
    data: [
      {y: '2011 Q1', item1: 2666},
      {y: '2011 Q2', item1: 2778},
      {y: '2011 Q3', item1: 4912},
      {y: '2011 Q4', item1: 3767},
      {y: '2012 Q1', item1: 6810},
      {y: '2012 Q2', item1: 5670},
      {y: '2012 Q3', item1: 4820},
      {y: '2012 Q4', item1: 15073},
      {y: '2013 Q1', item1: 10687},
      {y: '2013 Q2', item1: 8432}
    ],
    xkey: 'y',
    ykeys: ['item1'],
    labels: ['Item 1'],
    lineColors: ['#efefef'],
    lineWidth: 2,
    hideHover: 'auto',
    gridTextColor: "#fff",
    gridStrokeWidth: 0.4,
    pointSize: 4,
    pointStrokeColors: ["#efefef"],
    gridLineColor: "#efefef",
    gridTextFamily: "Open Sans",
    gridTextSize: 10
  });

  //Fix for charts under tabs
  $('.box ul.nav a').on('shown.bs.tab', function () {
    area.redraw();
    donut.redraw();
    line.redraw();
  });
 
  
});

//TODO: Remover todos os exemplos abaixo após desenvolvimento
$(function () {

  "use strict";

  //Make the dashboard widgets sortable Using jquery UI
  $(".connectedSortable").sortable({
    placeholder: "sort-highlight",
    connectWith: ".connectedSortable",
    handle: ".box-header, .nav-tabs",
    forcePlaceholderSize: true,
    zIndex: 999999
  });
  $(".connectedSortable .box-header, .connectedSortable .nav-tabs-custom").css("cursor", "move");

  //jQuery UI sortable for the todo list
  $(".todo-list").sortable({
    placeholder: "sort-highlight",
    handle: ".handle",
    forcePlaceholderSize: true,
    zIndex: 999999
  });

  //bootstrap WYSIHTML5 - text editor
  $(".textarea").wysihtml5();

  $('.daterange').daterangepicker({
    ranges: {
      'Today': [moment(), moment()],
      'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Last 7 Days': [moment().subtract(6, 'days'), moment()],
      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      'This Month': [moment().startOf('month'), moment().endOf('month')],
      'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment().subtract(29, 'days'),
    endDate: moment()
  }, function (start, end) {
    window.alert("You chose: " + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
  });

  /* jQueryKnob */
  $(".knob").knob();

  //jvectormap data
  var visitorsData = {
    "US": 398, //USA
    "SA": 400, //Saudi Arabia
    "CA": 1000, //Canada
    "DE": 500, //Germany
    "FR": 760, //France
    "CN": 300, //China
    "AU": 700, //Australia
    "BR": 600, //Brazil
    "IN": 800, //India
    "GB": 320, //Great Britain
    "RU": 3000 //Russia
  };
  //World map by jvectormap
  $('#world-map').vectorMap({
    map: 'world_mill_en',
    backgroundColor: "transparent",
    regionStyle: {
      initial: {
        fill: '#e4e4e4',
        "fill-opacity": 1,
        stroke: 'none',
        "stroke-width": 0,
        "stroke-opacity": 1
      }
    },
    series: {
      regions: [{
        values: visitorsData,
        scale: ["#92c1dc", "#ebf4f9"],
        normalizeFunction: 'polynomial'
      }]
    },
    onRegionLabelShow: function (e, el, code) {
      if (typeof visitorsData[code] != "undefined")
        el.html(el.html() + ': ' + visitorsData[code] + ' new visitors');
    }
  });

  //Sparkline charts
  var myvalues = [1000, 1200, 920, 927, 931, 1027, 819, 930, 1021];
  $('#sparkline-1').sparkline(myvalues, {
    type: 'line',
    lineColor: '#92c1dc',
    fillColor: "#ebf4f9",
    height: '50',
    width: '80'
  });
  myvalues = [515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921];
  $('#sparkline-2').sparkline(myvalues, {
    type: 'line',
    lineColor: '#92c1dc',
    fillColor: "#ebf4f9",
    height: '50',
    width: '80'
  });
  myvalues = [15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21];
  $('#sparkline-3').sparkline(myvalues, {
    type: 'line',
    lineColor: '#92c1dc',
    fillColor: "#ebf4f9",
    height: '50',
    width: '80'
  });

  //The Calender
  $("#calendar").datepicker();

  //SLIMSCROLL FOR CHAT WIDGET
  $('#chat-box').slimScroll({
    height: '250px'
  });

/* The todo list plugin */
  $(".todo-list").todolist({
    onCheck: function (ele) {
      window.console.log("The element has been checked");
      return ele;
    },
    onUncheck: function (ele) {
      window.console.log("The element has been unchecked");
      return ele;
    }
  });

});