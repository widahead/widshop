    var tz=-5;          /* -->Offset for your timezone in hours from UTC (see

                              http://wwp.greenwichmeantime.com/index.htm to find

                              the timezone offset for your location) */


    //-->    DO NOT CHANGE THE CODE BELOW!    <--

    d1 = new Image(); d1.src = JS_BASE_URL+"wid_shop/img/digital-numbers/1.png";

    d2 = new Image(); d2.src = JS_BASE_URL+"wid_shop/img/digital-numbers/2.png";

    d3 = new Image(); d3.src = JS_BASE_URL+"wid_shop/img/digital-numbers/3.png";

    d4 = new Image(); d4.src = JS_BASE_URL+"wid_shop/img/digital-numbers/4.png";

    d5 = new Image(); d5.src = JS_BASE_URL+"wid_shop/img/digital-numbers/5.png";

    d6 = new Image(); d6.src = JS_BASE_URL+"wid_shop/img/digital-numbers/6.png";

    d7 = new Image(); d7.src = JS_BASE_URL+"wid_shop/img/digital-numbers/7.png";

    d8 = new Image(); d8.src = JS_BASE_URL+"wid_shop/img/digital-numbers/8.png";

    d9 = new Image(); d9.src = JS_BASE_URL+"wid_shop/img/digital-numbers/9.png";

    d0 = new Image(); d0.src = JS_BASE_URL+"wid_shop/img/digital-numbers/0.png";

    bkgd = new Image(); bkgd.src = JS_BASE_URL+"wid_shop/img/digital-numbers/bkgd.gif";


    var montharray=new Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");


    function countdown(yr,m,d,hr,min){

        theyear=yr;themonth=m;theday=d;thehour=hr;theminute=min;

        var today=new Date();

        var todayy=today.getYear();

        if (todayy < 1000) {todayy+=1900;}

        var todaym=today.getMonth();

        var todayd=today.getDate();

        var todayh=today.getHours();

        var todaymin=today.getMinutes();

        var todaysec=today.getSeconds();

        var todaystring1=montharray[todaym]+" "+todayd+", "+todayy+" "+todayh+":"+todaymin+":"+todaysec;

        var todaystring=Date.parse(todaystring1)+(tz*1000*60*60);

        var futurestring1=(montharray[m-1]+" "+d+", "+yr+" "+hr+":"+min);

        var futurestring=Date.parse(futurestring1)-(today.getTimezoneOffset()*(1000*60));

        var dd=futurestring-todaystring;

        var dday=Math.floor(dd/(60*60*1000*24)*1);

        var dhour=Math.floor((dd%(60*60*1000*24))/(60*60*1000)*1);

        var dmin=Math.floor(((dd%(60*60*1000*24))%(60*60*1000))/(60*1000)*1);

        var dsec=Math.floor((((dd%(60*60*1000*24))%(60*60*1000))%(60*1000))/1000*1);

        
	startTimer = setTimeout("countdown(theyear,themonth,theday,thehour,theminute)",500);
	convert(dday,dhour,dmin,dsec);

    }


    function convert(d,h,m,s) {

        
        if (h <= 9) {

            document.images.h1.src = d0.src;

            document.images.h2.src = eval("d"+h+".src");

        }

        else {

            document.images.h1.src = eval("d"+Math.floor(h/10)+".src");

            document.images.h2.src = eval("d"+(h%10)+".src");

        }

        if (m <= 9) {

            document.images.m1.src = d0.src;

            document.images.m2.src = eval("d"+m+".src");

        }

        else {

            document.images.m1.src = eval("d"+Math.floor(m/10)+".src");

            document.images.m2.src = eval("d"+(m%10)+".src");

        }

        if (s <= 9) {

            document.images.s1.src = d0.src;

            document.images.s2.src = eval("d"+s+".src");

        }

        else {

            document.images.s1.src = eval("d"+Math.floor(s/10)+".src");

            document.images.s2.src = eval("d"+(s%10)+".src");

        }

    }