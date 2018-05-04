   
   $( function() {
    $( "#datepicker" ).datepicker({
     dateFormat: "dd/mm/yy",
     dayNames: [ "Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado"],
     monthNames: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro" ],
     dayNamesMin: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"]     
        });
    
  } );
  
  


 $(document).ready(function(){ 
 $("#datepicker").mask("99/99/9999"); 
 });

 $(document).ready(function(){
 $("#hora").mask("99:99:99");                
 });
