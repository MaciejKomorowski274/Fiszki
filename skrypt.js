
    var canvas, ctx, flag,perspektywaX,kursorX,perspektywaY,kursorY,flaga;
    flag=flaga=false;
    perspektywaX=kursorX=perspektywaY=kursorY=0;
    var x = "black",y = 2;
    function init() 
    {
        canvas = document.getElementById('can');
        ctx = canvas.getContext("2d");
        w = canvas.width;
        h = canvas.height;
        canvas.addEventListener("mousemove", function (e) {findxy('move', e)}, false);
        canvas.addEventListener("mousedown", function (e) {findxy('down', e)}, false);
        canvas.addEventListener("mouseup", function (e) {findxy('up', e)}, false);
        canvas.addEventListener("mouseout", function (e) {findxy('out', e)}, false);
    }
    
    function draw() 
    {
        ctx.beginPath();
        ctx.moveTo(perspektywaX, perspektywaY);
        ctx.lineTo(kursorX, kursorY);
        ctx.strokeStyle = x;
        ctx.lineWidth = y;
        ctx.stroke();
        ctx.closePath();
    }
    
    function erase() 
    {
        var m = confirm("Czyszczenie tablicy");
        if (m) 
        {
            ctx.clearRect(0, 0, w, h);
            document.getElementById("canvasimg").style.display = "none";
        }
    }
    

    
    function findxy(res, e) 
    {
        if (res == 'down') 
        {
            perspektywaX = kursorX;
            perspektywaY = kursorY;
            kursorX = e.clientX - canvas.offsetLeft;
            kursorY = e.clientY - canvas.offsetTop;
            flag = true;
            flaga = true;
            if (flaga) 
            {
                ctx.beginPath();
                ctx.fillStyle = x;
                ctx.fillRect(kursorX, kursorY, 2, 2);
                ctx.closePath();
                flaga = false;
            }
        }
        if (res == 'up' || res == "out") 
        {
            flag = false;
        }
        if (res == 'move') 
        {
            if (flag) 
            { perspektywaX = kursorX;
            perspektywaY = kursorY;
                kursorX = e.clientX - canvas.offsetLeft;
                kursorY = e.clientY - canvas.offsetTop;
                draw();
            }
        }
    }
       
    function tablica() 
    {
        var przod=document.getElementById("przod").value;
        document.getElementById("odpowiedzi").innerHTML = '<center><h1>'+przod+'</h1></center><canvas id="can" width="300" height="300" style="border:2px solid;"></canvas><input type="button" value="Wyczyść" id="clr" size="23" onclick="erase()"><input type="button" value="Odopowiedź"  id="tyl" onclick="tyl()" >';init();

    }
        
    function array() 
    {
        var przod=document.getElementById("przod").value;
        var tyl=document.getElementById("tyl").value;
        document.getElementById("odpowiedzi").innerHTML = '<p><center><h1>'+przod+'</h1></p><p><textarea cols="40" rows="10">Tu wpisz tekst będący odpowiedzią</textarea></p><p><input type="button" value="Odopowiedź"  id="tyl" onclick="tyl()" ></p></center>';

    }
      
    function tyl()
    {
        var tyl=document.getElementById("tyl").value;
        document.getElementById("testtylu").innerHTML = '<center><h1>'+tyl+'</h1></center>';
    }
       
      function karta() 
    {
        var przod=document.getElementById("przod").value;
        var tyl=document.getElementById("tyl").value;
        document.getElementById("odpowiedzi").innerHTML = '<p><center><div id="rodzic"><div class="dziecko1"><div class="calosc"><div class="karta"><div id="przod">'+przod+'</div><div class="tyl">'+tyl+'</div></div></div></div></div></center></P>';
        document.getElementById("testtylu").innerHTML = '';
    }

