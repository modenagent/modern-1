<table class="" id="user-table">
    <thead>
        <tr>
            <th class="col-md-3" >Phone Number</th>
            <th class="col-md-3">User Name</th>
            <th class="col-md-3">Created Date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($leads as $lead): ?>
        <tr>
            <td><?php echo $lead->phone_number ?> </td>
            <td><?php echo $lead->first_name.' '.$lead->last_name ?> </td>
            <td class="text-right"><?php echo date("F j, Y", strtotime($lead->created_at)) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>