<?php if (!defined('THINK_PATH')) exit();?><html>
    <head>
        <style type="text/css">
            .main{
                font-weight: bold ;
                color: white;   
                background-color: black;
                height: 300px;
                width: 450px;
                resize : none;
            }
            
        </style>
        <script type="text/javascript"  src="/ot/Public/static/jquery-2.0.3.min.js">
        </script>
        <script>
            $(document).ready(function(){
                var count = 1;
                var $textarea = $("textarea");
                $textarea.keydown(function(event) {
                    
                    /* Act on the event */
                    if(event.which == 13){
                        var main = $textarea.val();
                        var arr = main.split('\n');
                        count++;
                        $(".info").append(arr[count]);
                    }
                });

            })
        </script>
    </head>
    <body>
        <div class="content">
            <textarea class="main">Microsoft Windows [版本 6.2.9200]
(c) 2012 Microsoft Corporation。保留所有权利。
C:\Users\Administrator></textarea>
        </div>
        <span class="info"></span>
    </body>
</html>