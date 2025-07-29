<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Load security helper for CSRF token
$this->load->helper('security');
$csrf_token = $this->security->get_csrf_hash();

// Template data
$template_data = array(
    'title' => 'User Profile',
    'csrf_token' => $csrf_token,
    'breadcrumbs' => array(
        array('title' => 'Dashboard', 'url' => site_url('admin/dashboard')),
        array('title' => 'User Profile', 'url' => '')
    ),
    'additional_css' => array(),
    'additional_js' => array(
        'assets/js/jquery.validate.min.js',
        'assets/js/jquery-toastr/toastr.min.js',
        'assets/js/jquery-toastr/ui-toastr-notifications.js',
        'assets/js/extra.js'
    )
);

// Helper function for role-specific back URL
function getRoleBackUrl($roleId) {
    switch ($roleId) {
        case '1': return site_url('admin/manage_admin_user');
        case '2': return site_url('admin/manage_companies');
        case '3': return site_url('admin/manage_sales_reps');
        case '4': return site_url('admin/manage_user');
        default: return site_url('admin/dashboard');
    }
}

// Secure user data with proper escaping
$safe_user = array(
    'first_name' => htmlspecialchars($users->first_name ?? '', ENT_QUOTES, 'UTF-8'),
    'last_name' => htmlspecialchars($users->last_name ?? '', ENT_QUOTES, 'UTF-8'),
    'email' => htmlspecialchars($users->email ?? '', ENT_QUOTES, 'UTF-8'),
    'phone' => htmlspecialchars($users->phone ?? '', ENT_QUOTES, 'UTF-8'),
    'user_name' => htmlspecialchars($users->user_name ?? '', ENT_QUOTES, 'UTF-8'),
    'license_no' => htmlspecialchars($users->license_no ?? '', ENT_QUOTES, 'UTF-8'),
    'company_name' => htmlspecialchars($users->company_name ?? '', ENT_QUOTES, 'UTF-8'),
    'company_add' => htmlspecialchars($users->company_add ?? '', ENT_QUOTES, 'UTF-8'),
    'role_id_fk' => (int)($users->role_id_fk ?? 0),
    'is_active' => $users->is_active ?? 'N',
    'user_id_pk' => (int)($users->user_id_pk ?? 0)
);

// Profile image handling with validation
$profile_image = 'assets/img/user.jpg'; // Default image
if (!empty($users->profile_image) && file_exists($users->profile_image)) {
    $profile_image = htmlspecialchars($users->profile_image, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($template_data['title']); ?></title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/img/favicon.ico'); ?>" type="image/x-icon">
    <!-- CSS Assets -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/js/jquery-ui/jquery-ui.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-reset.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/fontawesome-6.6.0/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.dataTables.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/jquery-toastr/toastr.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/admin-style.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/optimizations.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-combobox.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/summernote.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/datepicker.css'); ?>">
    <!-- JavaScript Assets (deferred for performance) -->
    <script defer src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
    <script defer src="<?php echo base_url('assets/editor/js/prism.js'); ?>"></script>
    <script defer src="<?php echo base_url('assets/editor/js/fabric.js'); ?>"></script>
    <script defer src="<?php echo base_url('assets/editor/js/master.js'); ?>"></script>
    <?php foreach ($template_data['additional_js'] as $js): ?>
        <script defer src="<?php echo base_url($js); ?>"></script>
    <?php endforeach; ?>
    <!-- Inline CSS for profile page -->
    <style>
        .profile-container { display: flex; flex-wrap: wrap; gap: 20px; }
        .profile-sidebar { flex: 0 0 300px; }
        .profile-main { flex: 1; min-width: 0; }
        .profile-card { background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 20px; text-align: center; }
        .profile-avatar { position: relative; margin-bottom: 15px; }
        .avatar-img { width: 120px; height: 120px; border-radius: 50%; object-fit: cover; }
        .avatar-edit-btn { position: absolute; bottom: 0; right: 0; background: #007bff; color: #fff; border: none; border-radius: 50%; padding: 8px; cursor: pointer; }
        .status-badge { display: inline-flex; align-items: center; gap: 5px; padding: 5px 10px; border-radius: 12px; font-size: 0.9em; }
        .status-active { background: #dff0d8; color: #3c763d; }
        .status-inactive { background: #f2dede; color: #a94442; }
        .info-section { margin-bottom: 20px; }
        .info-grid { display: grid; gap: 10px; }
        .info-item { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #eee; }
        .info-label { font-weight: bold; color: #555; }
        .info-value { color: #333; }
        .subscription-card { background: #fff; border-radius: 8px; padding: 15px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .subscription-header { display: flex; justify-content: space-between; align-items: center; }
        .subscription-badge { padding: 5px 10px; border-radius: 12px; font-size: 0.9em; }
        .subscription-badge.active { background: #dff0d8; color: #3c763d; }
        .subscription-badge.inactive { background: #f2dede; color: #a94442; }
        .modal-content { border-radius: 8px; }
        .image-preview img { max-width: 100%; height: auto; margin-top: 10px; }
        @media (max-width: 768px) { .profile-sidebar { flex: 0 0 100%; } }
    </style>
</head>
<body>
    <div class="content">
        <!-- Breadcrumbs (from master, using template_data) -->
        <div class="breadLine">
            <ul class="breadcrumb">
                <?php foreach ($template_data['breadcrumbs'] as $crumb): ?>
                    <?php if ($crumb['url']): ?>
                        <li><a href="<?php echo $crumb['url']; ?>"><?php echo htmlspecialchars($crumb['title']); ?></a></li>
                    <?php else: ?>
                        <li class="active"><?php echo htmlspecialchars($crumb['title']); ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="clearfix"></div>

        <!-- Profile Content (combined from copilot and master) -->
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4 class="panel-title">User Profile</h4>
            </div>
            <div class="panel-body">
                <div class="profile-container">
                    <!-- Profile Sidebar (from copilot, styled like master) -->
                    <aside class="profile-sidebar col-sm-5 col-md-4" role="complementary">
                        <div class="profile-card user-left text-center">
                            <div class="profile-avatar">
                                <img src="<?php echo base_url($profile_image); ?>" 
                                     alt="Profile picture of <?php echo $safe_user['first_name'] . ' ' . $safe_user['last_name']; ?>"
                                     class="avatar-img img-responsive"
                                     loading="lazy">
                                <button type="button" class="avatar-edit-btn" aria-label="Change profile picture">
                                    <i class="fa fa-camera" aria-hidden="true"></i>
                                </button>
                            </div>
                            <h4><?php echo ucfirst($safe_user['first_name']) . ' ' . ucfirst($safe_user['last_name']); ?></h4>
                            <p class="profile-username">@<?php echo $safe_user['user_name']; ?></p>
                            <div class="profile-status">
                                <?php if ($safe_user['is_active'] === 'Y'): ?>
                                    <span class="status-badge status-active" aria-label="User is active">
                                        <i class="fa fa-check-circle" aria-hidden="true"></i> Active
                                    </span>
                                <?php else: ?>
                                    <span class="status-badge status-inactive" aria-label="User is inactive">
                                        <i class="fa fa-times-circle" aria-hidden="true"></i> Inactive
                                    </span>
                                <?php endif; ?>
                            </div>
                            <hr>
                            <div class="page-actions">
                                <a href="<?php echo getRoleBackUrl($safe_user['role_id_fk']); ?>" class="btn btn-secondary">
                                    <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to List
                                </a>
                                <a href="<?php echo site_url('admin/edit_user/' . $safe_user['user_id_pk']); ?>" class="btn btn-primary">
                                    <i class="fa fa-edit" aria-hidden="true"></i> Edit Profile
                                </a>
                            </div>
                        </div>
                    </aside>

                    <!-- Profile Details (from master, enhanced with copilot) -->
                    <main class="profile-main col-sm-7 col-md-8" role="main">
                        <section class="info-section" aria-labelledby="personal-info-heading">
                            <header class="section-header">
                                <h3 id="personal-info-heading" class="section-title">Personal Information</h3>
                            </header>
                            <table class="table table-condensed table-hover">
                                <tbody>
                                    <tr>
                                        <td class="info-label">Name</td>
                                        <td class="info-value"><?php echo ucfirst($safe_user['first_name']) . ' ' . ucfirst($safe_user['last_name']); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="info-label">Email</td>
                                        <td class="info-value">
                                            <a href="mailto:<?php echo $safe_user['email']; ?>" 
                                               class="email-link"
                                               aria-label="Send email to <?php echo $safe_user['email']; ?>">
                                                <?php echo $safe_user['email']; ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="info-label">Phone</td>
                                        <td class="info-value">
                                            <?php if (!empty($safe_user['phone'])): ?>
                                                <a href="tel:<?php echo $safe_user['phone']; ?>" 
                                                   class="phone-link"
                                                   aria-label="Call <?php echo $safe_user['phone']; ?>">
                                                    <?php echo $safe_user['phone']; ?>
                                                </a>
                                            <?php else: ?>
                                                <span class="text-muted">Not provided</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="info-label">Username</td>
                                        <td class="info-value"><?php echo $safe_user['user_name']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </section>

                        <!-- Professional Information (from copilot) -->
                        <?php if ($safe_user['role_id_fk'] != 1): ?>
                            <section class="info-section" aria-labelledby="professional-info-heading">
                                <header class="section-header">
                                    <h3 id="professional-info-heading" class="section-title">Professional Information</h3>
                                </header>
                                <table class="table table-condensed table-hover">
                                    <tbody>
                                        <?php if (!empty($safe_user['license_no'])): ?>
                                            <tr>
                                                <td class="info-label">License Number</td>
                                                <td class="info-value"><?php echo $safe_user['license_no']; ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if (!empty($safe_user['company_name'])): ?>
                                            <tr>
                                                <td class="info-label">
