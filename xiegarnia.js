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
                    li.append('<input type="button" value="Info" id="infoBtn">'+
                            '<input type="button" value="Usuń" id="delBtn">' +
                            '</div>');
                    li.append('<div class="booksInfo">' +
                            '<p> Autor: ' + book.author + '</p>' +
                            '<p> Opis: ' + book.description + '</p>' + 
                            '</div>' );
                    li.attr("data-id", book.id);
                    ol.append(li);
            });
        });
    };  
   
    function addBook() {
        var sendBtn = $('#sendBtn');
        
        sendBtn.click(function() {
            
           var name = $('#name');
           var author = $('#author');
           var description = $('#description');
           
           $.post({
               url: 'api/books.php', 
               data: { name: name.val(), 
                   author: author.val(), description: description.val()},
               })
                .done(function(response) {
                    alert(response)
                    if(response == "success") {
                        loadBook();
                        name.val("");                        
                        author.val("");
                        description.val("");
                        alert('Książkę dodano!');
                    } else if (response == "empty") {
                        alert('Coś jest źle!');
                    }
                })
                        .fail(function() {
                            alert('Coś poszło nie tak');
                        })
        });
    }
    
        
   loadAllBooks(); 
   addBook();
});


