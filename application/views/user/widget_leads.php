<style type="text/css">
    div#table-dt-leads_length select {
    border: none;
    padding: 5px 10px;
    border-radius: 4px;
    color: #555;
  
     background-color:#fff;
    /* box-shadow: 2px 2px 3px #ccc inset; */
}
div#table-dt-leads_filter input {
    padding: 5px 10px;
    border: none;
    border-radius: 4px;
    background-color: #fff;
    color: #555;
}
#cma-widget-container #table-dt-leads_filter label input,
#cma-widget-container #table-dt-leads_length label select {
    border-radius: 0px;
}
#table-dt-leads_filter label input,
#table-dt-leads_length label select {
    border-radius: 0px;
}
#table-dt-leads_filter label input,
#table-dt-leads_length label select {
    border-radius: 0px;
}
.dataTables_wrapper div#table-dt-leads_filter input {
    padding: 5px 10px;
    border: none;
    border-radius: 4px;
    background-color: #fff;
    color: #555;
}
</style>
<div class="table-responsive">
    <table class="actions" id="table-dt-leads">
        <thead>
            <tr>
                <th>DATE</th>
                <th>PHONE NUMBER</th>
                <th>OWNER</th>
                <th>PROPERTY ADDRESS</th>
                <th>REPORT TYPE</th>
                <th>ACTIONS</th>
            </tr>   
        </thead>
        <tbody>
            <?php

                if(isset($leads) && !empty($leads))
                {
                    foreach ($leads as $key => $lead) 
                    {
            ?>
                        <tr>
                        <td>
                            <?php echo date("m/d/Y", strtotime($lead->created_at)); ?>                    
                        </td>
                        <td><?php echo $lead->phone_number; ?></td>
                        <td><?php echo $lead->project_id_pk . '-' . $lead->property_owner; ?></td>
                        <td><?php echo $lead->project_name; ?></td>
                        <td><?php echo ucfirst($lead->report_type); ?></td>
                        <td>
                            <a href=<?php echo base_url().$lead->report_path; ?> download target="_blank"><i data-toggle="tooltip" title="Download" class="icon icon-download"></i></a>
                        </td>
                        </tr>
            <?php
                    }
                }
                else
                {
            ?>
                    <tr>
                        <td colspan="5">Leads not found.</td>
                    </tr>
            <?php
                } 
            ?>
        </tbody>
    </table>
</div>