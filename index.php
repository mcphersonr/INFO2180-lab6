<!DOCTYPE html>
<html>
    <head>
        <link rel='stylesheet' type='text/css' href='request.css'>
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
                
                let main =document.getElementById('main');
            
                main.appendChild(textfield);
                main.appendChild(searchbutton);

                searchbutton.addEventListener('click',function(){
                    let word = document.getElementById('word').value;
                    if (word!==''){
                        let httpRequest = new XMLHttpRequest();
                        
                        httpRequest.onreadystatechange = function (){
                            if((httpRequest.readyState===XMLHttpRequest.DONE && httpRequest.status === 200)){
                                let div= document.createElement('div');
                                div.setAttribute('id','result');
                                let p = document.createElement('p');
                                let ptext=document.createTextNode(div.id.toUpperCase());
                                p.appendChild(ptext);
                                p.classList.add('resultheading');
                                let response=httpRequest.responseText;
                                div.innerHTML=(response);
                                div.insertBefore(p,div.childNodes[0]);
                                main.style.height='auto';
                                main.appendChild(div);
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
        <header>
            <p class='heading'>Web Dictionary</p>
        </header>
        
        <section id='main'>
            <p>Lookup the definition of a word (e.g. ajax, html, bar, php, javascript or css)</p>
        </section>
    </body>
</html>
