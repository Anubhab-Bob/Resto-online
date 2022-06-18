<html>
	<body bgcolor="aqua">
    <h1 align="center"><font size="10"><ins><big><font color='darkorange'>Admin Page</font></big></ins></font></h1>
    <hr><hr>
    <body>

        <form action ="" method = "POST">
            <h4>Delivery Boy Details : </h4>
            <b>ID : <select id = "d_id" onchange="populate_delivery_boy()"> </select>
            <b>Name : <input type = "text" id = "d_name">
            <b>Area : <select id = "d_area"> </select>
            <button type="button" onclick="update_delivery_boy()"><b>Update</b></button>
            <hr>

            <h4>Items Details : </h4>
            <b>ID : <select id = "i_id" onchange="populate_item()"> </select>
            <b>Name : <input type = "text" id = "i_name">
            <b>Price : <input type = "number" id = "i_price">
            <button type="button" onclick="update_item()"><b>Update</b></button>
            <hr>
        </form>
        <a href="Query_Input.html">Run Queries</a>
    <script>

        function post_data_parse(file, data, doSomething) {
            var http = new XMLHttpRequest();
            var url = file;
            var params = data;
            http.open('POST', url, true);

            //Send the proper header information along with the request
            http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            http.onreadystatechange = function() 
            {
                //Call a function when the state changes.
                //Basically do the following steps when the state changes.
                //HTTP has 4 states where state 4 is when data,response is downloaded correctly
                //HTTP response status = 200 means all okay
                if(http.readyState == 4 && http.status == 200) 
                {
                    //Function is called after decoding the json encoding by parsing the recieved text format.
                    doSomething(JSON.parse(http.responseText));
                }
            }
            http.send(params);
        }

        //For updation queries the result is either true or false. 
        //So there is no need for parsing. This function calls the updation functions without any decoding
        function post_data(file, data, doSomething) 
        {
            var http = new XMLHttpRequest();
            var url = file;
            var params = data;
            http.open('POST', url, true);

            //Send the proper header information along with the request
            http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            http.onreadystatechange = function() 
            {
                //Call a function when the state changes.
                //HTTP has 4 states where state 4 is when data,response is downloaded correctly
                //HTTP response status = 200 means all okay
                if(http.readyState == 4 && http.status == 200) 
                {
                    //The function is called without any encoding as no table is being generated which needs to be parsed
                    doSomething(http.responseText);
                }
            }
            http.send(params);
        }

        function setSelectedValue(name, valueToSet) {
            var selectObj = document.getElementById(name);
            for (var i = 0; i < selectObj.options.length; i++) {
                if (selectObj.options[i].text== valueToSet) {
                    selectObj.options[i].selected = true;
                    return;
                }
            }
        }

        function set_delivery_boy(x) 
        {

            var res = x[0];
            //setSelectedValue is required whene we are selecting a value from combobox.
            setSelectedValue("d_id", res.employee_id);
            document.getElementById("d_name").value = res.name;
            setSelectedValue("d_area", res.AreaName);
        }

        function set_item(x) {
            var res = x[0];
            setSelectedValue("i_id", res.item_id);
            document.getElementById("i_name").value = res.name;
            document.getElementById("i_price").value = res.price;
        }

        function populate_dropdown(elname, data, decode_fn) 
        {
            var select = document.getElementById(elname);
            for(var i = 0;i < data.length; i++) 
            {
                var opt = decode_fn(data[i]);
                var el = document.createElement("option");
                el.textContent = opt;
                el.value = opt;
                select.appendChild(el);
            }
            return select;
        }

        function populate_delivery_boy() {
            var selected = document.getElementById("d_id").value;
            var result = post_data_parse("admin_helper.php", "query=delivery_boy_info&id="+selected, function(x) { set_delivery_boy(x);})
            //console.log(result);
        }

        function populate_item() {
            var selected = document.getElementById("i_id").value;
            var result = post_data_parse("admin_helper.php", "query=item_info&id="+selected, function(x) { set_item(x);})
            //console.log(result);
        }

        function populate_delivery_ids() {
            var result = post_data_parse("admin_helper.php", "query=delivery_boy_idx", function(x){
                var select = populate_dropdown("d_id", x, function(x) { return x.employee_id; })
                select.selectedIndex = 0;
                populate_delivery_boy();
            });

        }

        function populate_item_ids() {
            var result = post_data_parse("admin_helper.php", "query=item_idx", function(x){
                var select = populate_dropdown("i_id", x, function(x) { return x.item_id; });
                select.selectedIndex = 0;
                populate_item();
            });
        }

        function populate_areas() {
            var result = post_data_parse("admin_helper.php", "query=areanames", function(x) {
                var select = populate_dropdown("d_area", x, function(x) { return x.AreaName; })
                select.selectedIndex = 0;
            });
        }

        function populate_all() {
            populate_areas();
            populate_delivery_ids();
            populate_item_ids();
        }

        function update_delivery_boy() {
            var id = document.getElementById("d_id").value;
            var name = encodeURIComponent(document.getElementById("d_name").value);
            var areaname = document.getElementById("d_area").value;
            console.log(name);
            post_data("admin_helper.php", "query=delivery_boy_update&id="+id+"&name="+name+"&areaname="+areaname, function(x) {
                console.log(x);
            })
        }

        function update_item() {
            var id = document.getElementById("i_id").value;
            var name = encodeURIComponent(document.getElementById("i_name").value);
            var price = document.getElementById("i_price").value;
            console.log(name);
            post_data("admin_helper.php", "query=item_update&id="+id+"&name="+name+"&price="+price, function(x) {
                console.log(x);
            })
        }


        window.onload = populate_all;
    </script>
</html>
