<!DOCTYPE html>
<html>
<head lang="en">
    <title>search history demo</title>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        body{
            margin-left: 300px;
        }
        ul{
            list-style: none;
        }
        ul li,div{
            width: 250px;
            padding: 10px 0;
            margin-left: 10px;
            border-bottom: 1px dashed #ccc;
            height: 20px;
        }
        a{
            float: right;
        }
        input{
            padding: 5px;
            margin: 10px;
        }
    </style>
</head>
<body>
<input type="search" placeholder="enter in something "/>
<input type="button" value="search"/>
<div><a href="javascript:;">clear history</a></div>
<ul>
    <li>no search history</li>
    <li><span>cellphone </span><a href="javascript:;">del</a></li>
   
</ul>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $(function () {
        /*1. use json save search history */
        /*2. key   historyList */
        /*3. json format arraylist*/
        /*4. such as [computer，cellphone ，。。。。]*/

        /*1.By default, the history list is rendered based on the history*/
        var historyListJson = localStorage.getItem('historyList') || '[]';
        var historyListArr = JSON.parse(historyListJson);
        /*Got the data in array format*/
        var render = function () {
            /*$.each(function(i,item){}) for() for in */
            /* forEach The traversal function can only be called from an array back to the function (all corresponding values, indexes).*/
            var html = '';
            historyListArr.forEach(function (item,i) {
                html += '<li><span>'+item+'</span><a data-index="'+i+'" href="javascript:;">delete</a></li>';
            });
            html = html || '<li>No search history </li>';
            $('ul').html(html);
        }
        render();

        /*2.Update the history render list when you click search*/
        $('[type="button"]').on('click',function () {
            var key = $.trim($('[type=search]').val());
            if(!key){
                alert('entering something');
                return false;
            }
            /*add a history */
            historyListArr.push(key);
            /*save*/
            localStorage.setItem('historyList',JSON.stringify(historyListArr));
            /*Render once*/
            render();
            $('[type=search]').val('');
        });

        /*3.Delete the history render list when you click delete*/
        $('ul').on('click','a',function () {
            var index = $(this).data('index');
            /*delete*/
            historyListArr.splice(index,1);
            /*save*/
            localStorage.setItem('historyList',JSON.stringify(historyListArr));
            /*render once */
            render();
        });

        /*4.Clear the history render list when you hit clear*/
        $('div a').on('click',function () {
            /*clear*/
            historyListArr = [];
            /*Clear all local storage on the network*/
            //localStorage.clear();
            //localStorage.removeItem('historyList');
            localStorage.setItem('historyList','');
            render();
        });
    });
</script>
</body>
</html>
