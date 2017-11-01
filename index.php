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
                
                let getdefin = document.createElement('BUTTON');
                getdefin.classList.add('button');
                let getnote = document.createTextNode('Get All Definitions');
                getdefin.appendChild(getnote);
                
                let main =document.getElementById('main');
            
                main.appendChild(textfield);
                main.appendChild(searchbutton);
                main.appendChild(getdefin);

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
                
                getdefin.addEventListener('click',function(){
                    let httpRequest = new XMLHttpRequest();
                    let all = 'all';
                    let test =''
                    httpRequest.onreadystatechange = function (){
                        if((httpRequest.readyState===XMLHttpRequest.DONE && httpRequest.status === 200)){
                            let div= document.createElement('div');
                            div.setAttribute('id','result');
                            let p = document.createElement('p');
                            let ptext=document.createTextNode(div.id.toUpperCase());
                            p.appendChild(ptext);
                            p.classList.add('resultheading');
                            let response=httpRequest.responseXML;
                            let ol = document.createElement('ol');
                            for(let i=1; i<(response.documentElement.childElementCount+response.documentElement.childElementCount);i+=2){
                                let li = document.createElement('LI');
                                let h3 = document.createElement('H3');
                                h3.classList.add('head');
                                let p1 = document.createElement('p');
                                let p2 = document.createElement('p');
                                h3.appendChild(document.createTextNode(response.documentElement.childNodes[i].attributes[0].value.toUpperCase()));
                                li.appendChild(h3);
                                li.appendChild(p1.appendChild(document.createTextNode(response.documentElement.childNodes[i].innerHTML)));
                                li.appendChild(document.createElement('br'));
                                li.appendChild(document.createElement('br'));
                                li.appendChild(p2.appendChild(document.createTextNode('- '+response.documentElement.childNodes[i].attributes[1].value)));
                                li.appendChild(document.createElement('br'));
                                li.appendChild(document.createElement('br'));
                                ol.appendChild(li);
                                
                            }
                            div.appendChild(ol);
                            div.insertBefore(p,div.childNodes[0]);
                            main.style.height='auto';
                            main.appendChild(div);
                        }
                    }
                    httpRequest.open('GET', 'request.php?q='+all,true);
                    httpRequest.send();
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
