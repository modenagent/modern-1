<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>
$( function() {
  $( "#accordion" ).accordion();
} );
</script>
<div class="container"   style="background-color: white;">
    <div class="row-fluidasd">
           <div class="navbar navbar-inner block-header">
               <div class="muted pull-left">API Documentations</div>
           </div>
           <div id="accordion">
                <h3>&nbsp;&nbsp;&nbsp; User Login</h3>
                <div>
                    <p>
                    Request: POST<br/>
                    API URL: modernagent.io/auth/userlogin/format/json/'<br/>
                    Request Data/Response Data format: JSON(application/json)<br/>
                    Sample post request data: <br/>
                      <pre><code>
data: {
    uemail: "youemail@example.com",
    upass: "userpassword"
}
                   </code></pre>
                  Sample response: <br/>
                      <pre><code>
{
    status:"success",
    msg:"login successful",
    data:{
            userid'    => "1",
            username'  => "Your Name",
            user_email: "youemail@example.com",
            logged_in: TRUE
        }
}
                   </code></pre>
                   <pre><code>
{
    status:"error",
    msg:"Wrong Email or Password"
}
                   </code></pre><br/>
                    </p>
                </div>
                
                
                <h3>&nbsp;&nbsp;&nbsp; User Logout</h3>
                <div>
                    <p>
                    Request: GET<br/>
                    API URL: modernagent.io/auth/userlogout/format/json/'<br/>
                    Request Data/Response Data format: JSON(application/json)<br/>
                    Sample response: <br/>
                      <pre><code>
{
    status:"success",
    msg:"Logout successfully."
}
                   </code></pre>
                    </p>
                </div>
                
                
                <h3>&nbsp;&nbsp;&nbsp; Forgot Password</h3>
                <div>
                    <p>
                    Request: Post<br/>
                    API URL: modernagent.io/auth/userlogout/format/json/'<br/>
                    Request Data/Response Data format: JSON(application/json)<br/>
                    Sample post request data: <br/>
                      <pre><code>
data: {
    uemail: "youemail@example.com"
}
                   </code></pre>
                    Sample response: <br/>
                      <pre><code>
{
    status:"success",
    msg:"Password has been sent to your registered email."
}
                   </code></pre>
                    </p>
                </div>
                
                <h3>&nbsp;&nbsp;&nbsp; User Registration</h3>
                <div>
                    <p>
                    Request: POST<br/>
                    API URL: modernagent.io/auth/userregister/format/json/'<br/>
                    Request Data/Response Data format: JSON(application/json)<br/>
                    Sample post request data: <br/>
                      <pre><code>
data: {
    password : "yourpassword",
    first_name: "Your",
    last_name: "Name",
    email: "youemail@example.com",
    ref_code: "REF00001",
    company_name:  "Your Company",
    company_add: "asd asd",
    company_city: "asd",
    comapny_zip: "12345",
    registered_date: "2018-01-01 10:10:10',
    is_active: "Y"
}
                   </code></pre>
                  Sample response: <br/>
                      <pre><code>
{
    status:"success",
    msg:"User added successfully."
}
                   </code></pre>
                    </p>
                </div>
                
                <h3>&nbsp;&nbsp;&nbsp; Recent Reports</h3>
                <div>
                    <p>
                    Request: GET<br/>
                    API URL: modernagent.io/lp/get_reports'<br/>
                    Request Data/Response Data format: JSON(application/json)<br/>
                    Sample response: <br/>
                      <pre><code>
{
    "status":"success",
    "data":[
            {"project_id_pk":"2080","project_name":"1358 5TH ST","property_owner":"HERNANDEZ, GERARDO JOVANNI; MENDOZA, YESSICA S","property_address":"1358 5TH ST, LA VERNE CA 91750","user_id_fk":"74","report_path":"temp\/1358 5TH ST_430b74570a66e6765c5489f9f3c13fe2.pdf","property_apn":"8381-021-001","property_lat":"34.105439","property_lng":"-117.782125","project_date":"2018-01-03 10:21:28","is_active":"Y","report_type":"buyer"},
            {"project_id_pk":"2079","project_name":"1358 5TH ST","property_owner":"HERNANDEZ, GERARDO JOVANNI; MENDOZA, YESSICA S","property_address":"1358 5TH ST, LA VERNE CA 91750","user_id_fk":"74","report_path":"temp\/1358 5TH ST_70aa8fc78d202d9fbee7a0d7cde72481.pdf","property_apn":"8381-021-001","property_lat":"34.105439","property_lng":"-117.782125","project_date":"2018-01-03 10:19:10","is_active":"Y","report_type":"buyer"}
        ]
}
                   </code></pre>
                    </p>
                </div>
                
                
                <h3>&nbsp;&nbsp;&nbsp; Billing History</h3>
                <div>
                    <p>
                    Request: GET<br/>
                    API URL: modernagent.io/lp/get_bills'<br/>
                    Request Data/Response Data format: JSON(application/json)<br/>
                    Sample response: <br/>
                      <pre><code>
{
    "status":"success",
    "data":[
            {"project_id_pk":"2080","project_id":"2080","project_name":"1358 5TH ST","property_owner":"HERNANDEZ, GERARDO JOVANNI; MENDOZA, YESSICA S","property_address":"1358 5TH ST, LA VERNE CA 91750","report_path":"temp\/1358 5TH ST_430b74570a66e6765c5489f9f3c13fe2.pdf","property_apn":"8381-021-001","property_lat":"34.105439","property_lng":"-117.782125","total_amount":"0","paid_on":"2018-01-03","invoice_pdf":"assets\/uploads\/user_invoices\/5a4c61517e585.pdf","invoice_amount":"0","invoice_date":"2018-01-03 10:21:29"},
            ]
}
                   </code></pre>
                    </p>
                </div>
                
           </div>
    </div>
</div>
