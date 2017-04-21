$(function () {
   
    var ol = $('#booksList');
    
    function loadAllBooks() {
        //ol.html("");       
        //alert('aaa')
        // Loading all books from DB         
        //$.getJSON('api/books.php', function(response) {
        $.ajax({url: 'api/books.php', dataType: "json"})        
            .done(function(response) {
                //alert(response);
            response.forEach(function(book) {               
                var li = $('<li class="row"> </li>');
                li.append('<div class="oneBook">' + book.name);
                li.append('<input type="button" value="More Info" id="infoBtn">'+
                        '<input type="button" value="Delete" id="delBtn">' +
                        '</div>');
                li.append('<div class="booksInfo">' +
                        '<p> Autor: ' + book.author + '</p>' +
                        '<p> Opis: ' + book.description + '</p>' + 
                        '</div>' );
                li.attr("data-id", book.id);
                ol.append(li);
            });
        });
        
        
        $.ajax({
            url: "api/books.php",
               
          }).done(function(response) {
              
              //alert(response);
              
            
          });


    };
        
   loadAllBooks(); 
 
});


