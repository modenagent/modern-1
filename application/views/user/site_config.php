<style>
    .input-margin {
        margin: 0 auto;
    }

    #configForm .form-control {
        appearance: auto;
    }

    .checkbox-flag {
        width: 20%;
        height: 20px !important;
        display: block !important;
    }

    .display-flex {
        display: flex;
    }

</style>
<div class="tab_white_box">
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <strong>Success! </strong>
            <?php echo $this->session->flashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif;?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <strong>Error! </strong>
            <?php echo $this->session->flashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif;?>
    <h2 class="mini_title">Parameters Configuration </h2>

    <div class="agent_info_form">
        <form id="configForm" action="" method="post">

            <div class="row">
                <div class="col-md-8 input-margin display-flex">
                    <label for="exampleInputEmail1">Auto Select Comps: </label>
                    <input class="form-control checkbox-flag" type="checkbox" data-type="auto_comparable_flag" id="auto_comparable_flag" name="auto_comparable_flag" <?=(!empty($user_data) && $user_data['auto_comparable_flag'] == '1') ? 'Checked' : ''?> />
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <input type="submit" class="btn btn-lp save" id="" value="Save" />
                    <div class="alert alert-success" style="display:none"></div>
                </div>
            </div>

        </form>
    </div>
</div>