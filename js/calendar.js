async function callPhpMethod(ID){

  response = await fetch('./DAO/usingSubscDAO.php',{
    method: 'POST',
    headers:{'Content-Type': 'application/x-www-form-urlencoded',},
    body:'action=get_using_by_id_efnp&param='+encodeURIComponent(ID)
  });
  const data = await response.json();
    // 日付を使用した処理を実行
    // 変数に入れたり return したり
    var resultdata =[];
    for(var i = 0; i < data.result.length; i++){
      const { endfree, nextpay } = data.result[i];
      resultdata.push([endfree, nextpay]);
    } 
      return resultdata;
}

function generate_year_range(start, end) {
    var years = "";
    for (var year = start; year <= end; year++) {
        years += "<option value='" + year + "'>" + year + "</option>";
    }
    return years;
}
  
  var today = new Date();
  var currentMonth = today.getMonth();
  var currentYear = today.getFullYear();
  var selectYear = document.getElementById("year");
  var selectMonth = document.getElementById("month");
  
  var createYear = generate_year_range(1970, 2200);
  
  document.getElementById("year").innerHTML = createYear;
  
  var calendar = document.getElementById("calendar");
  var lang = calendar.getAttribute('data-lang');
  
  var months = ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"];
  var days = ["日", "月", "火", "水", "木", "金", "土"];
  
  var dayHeader = "<tr>";
  for (day in days) {
    dayHeader += "<th data-days='" + days[day] + "'>" + days[day] + "</th>";
  }
  dayHeader += "</tr>";
  
  document.getElementById("thead-month").innerHTML = dayHeader;
  
  monthAndYear = document.getElementById("monthAndYear");
  showCalendar(currentMonth, currentYear);
  
  function next() {
    currentYear = (currentMonth === 11) ? currentYear + 1 : currentYear;
    currentMonth = (currentMonth + 1) % 12;
    showCalendar(currentMonth, currentYear);
  }
  
  function previous() {
    currentYear = (currentMonth === 0) ? currentYear - 1 : currentYear;
    currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
    showCalendar(currentMonth, currentYear);
  }
  
  function jump() {
    currentYear = parseInt(selectYear.value);
    currentMonth = parseInt(selectMonth.value);
    showCalendar(currentMonth, currentYear);
  }
  
  async function showCalendar(month, year) {
  
    var firstDay = ( new Date( year, month ) ).getDay();
  
    tbl = document.getElementById("calendar-body");
  
    tbl.innerHTML = "";
  
    monthAndYear.innerHTML = months[month] + " " + year;
    selectYear.value = year;
    selectMonth.value = month;
  
    // creating all cells
    var date = 1;
    for ( var i = 0; i < 6; i++ ) {
        var row = document.createElement("tr");
  
        for ( var j = 0; j < 7; j++ ) {
            if ( i === 0 && j < firstDay ) {
                cell = document.createElement( "td" );
                cellText = document.createTextNode("");
                cell.appendChild(cellText);
                row.appendChild(cell);
            } else if (date > daysInMonth(month, year)) {

                break;
            } else {
                cell = document.createElement("td");
                cell.setAttribute("data-date", date);
                cell.setAttribute("data-month", month + 1);
                cell.setAttribute("data-year", year);
                cell.setAttribute("data-month_name", months[month]);
                cell.className = "date-picker";
                cell.innerHTML = "<span>" + date + "</span>";
                // console.log("today.getMonth()    ",today.getMonth() );

                if ( date === today.getDate() && year === today.getFullYear() && month === today.getMonth() ) {
                    cell.className = "date-picker selected";
                }
                

                // 無料期間と次回支払いを取得してカレンダーに反映する処理
                const memberid = document.getElementById("memberID");
                const all = await callPhpMethod(memberid.value);
                month = month + 1;
                if(date < 10){
                  date = "0" + date;
                }
                if(month < 10 && String(month).length < 2){
                  month = "0" + month;
                }
                
                for(var i = 0; i < all.length; i++){
                  const endfree = all[i][0];
                  const nextpay = all[i][1];
                  const [endyear,endmonth,endday] = endfree.split('-');
                  const [payyear,paymonth,payday] = nextpay.split('-');                              
                  if(date == endday && year == endyear && month == endmonth){
                      cell.className = "date-picker endfree";
                  }
                  if(date == payday && year == payyear && month == paymonth){
                      cell.className = "date-picker nextpay";
                  }
                }               
                if(date < 10){
                  date = date.replace("0","");
                  date = parseInt(date);
                }
                if(month < 10){
                  month = month.replace("0","");
                  month = parseInt(month);
                }

                month = month - 1;

                row.appendChild(cell);
                date++;
            }
        }
  
        tbl.appendChild(row);
    }
  
  }
  
  function daysInMonth(iMonth, iYear) {
    return 32 - new Date(iYear, iMonth, 32).getDate();
  }