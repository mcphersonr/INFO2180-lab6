<!DOCTYPE html>
<html>
    <head>
        <script>
            window.onload=function(){
                let searchbutton=document.createElement('BUTTON');
                searchbutton.classList.add('button')
                let note = document.createTextNode('Search');
                searchbutton.appendChild(note);
                
                let textfield = document.createElement('input');
                textfield.setAttribute('type','text');
                textfield.setAttribute('id','word');
                textfield.classList.add('input');
                
                document.body.appendChild(textfield);
                document.body.appendChild(searchbutton);
                
                
                searchbutton.addEventListener('click',function(){
                    let word = document.getElementById('word').value;
                    if (word!==''){
                        let httpRequest = new XMLHttpRequest();
                        
                        httpRequest.onreadystatechange = function (){
                            if((httpRequest.readyState===XMLHttpRequest.DONE && httpRequest.status === 200)){
                                let response=httpRequest.responseText;
                                alert(response);
                            }
                        }
                        httpRequest.open('GET', 'request.php?q='+word,true);
                        httpRequest.send();
                    }
                    
                    else{
                        alert('You must enter a word to search');
                    }
                });
            }
        </script>
    </head>
    <body>
    </body>
</html>