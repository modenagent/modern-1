<table class="" id="user-table">
    <thead>
        <tr>
            <th class="col-md-3" >Name</th>
            <th class="col-md-3">email</th>
            <th>Company</th>
            <th class="col-md-2">Creation Date</th>
            <th class="col-md-2">Actions</th>
        </tr>
    </thead>
    <?php /*
    <tbody>
        <?php foreach($users as $info): ?>
        <tr>
            <td><?php echo $info->first_name.' '.$info->last_name ?> </td>
            <td><?php echo $info->email ?></td>
            <td class="text-right"><?php echo $info->company_name ?></td>
            <td class="text-right"><?php echo date("F j, Y", strtotime($info->registered_date)) ?></td>
            <td>
                <div class="text-right">
                    <a class="btn btn-xs btn-info user_del" href="<?php echo site_url('admin/profile/'.$info->user_id_pk) ?>" data-toggle="tooltip"data-title="View detail"><i class="fa fa-eye"></i></a>
                    <?php if($this->role_lib->has_access('edit_user_info')): ?>
                    <a class="btn btn-xs btn-warning user_del" href="<?php echo site_url('admin/profile_edit/'.$info->user_id_pk) ?>" data-toggle="tooltip" data-title="Edit"><i class="fa fa-edit"></i></a>
                    <?php endif; ?>
                    <?php if($this->role_lib->has_access('del_user')): ?>
                    <a class="btn btn-xs btn-danger user_del" href="javascript:;" onclick="deleteuser('<?php echo $info->user_id_pk ?>');" data-toggle="tooltip" data-title="Delet"><i class="fa fa-times"></i></a>
                    <?php endif; ?>
                    <?php if($this->role_lib->has_access('deactive_user')): ?>
                        <?php if($info->is_active == 'N'): ?>
                        <a class="btn btn-xs btn-success" href="javascript:;" onclick="verifyuser('<?php echo $info->user_id_pk; ?>');" data-toggle="tooltip" data-title="Active"><i class="fa fa-check-circle"></i></a>
                        <?php else: ?>
                        <a class="btn btn-xs btn-warning" href="javascript:;" onclick="unverifyuser('<?php echo $info->user_id_pk; ?>');" data-toggle="tooltip" data-title="Deactive"><i class="fa fa-ban"></i></a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    */ ?>
</table>