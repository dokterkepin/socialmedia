<form method="post" action="/users/register" class="m-auto border px-5 pt-5" style="width: 23rem; color: #A6A5A8">
    <legend class="text-center mb-4 fw-bold" style="color: black">Register New Account</legend>

    <?php if(isset($model["error"])){ ?>
        <div class="alert alert-light text-danger" role="alert">
            <?= $model["error"] ?>
        </div>
    <?php } ?>

    <div class="mb-3">
        <label for="id" class="form-label">Id</label>
        <input name="id" id="id"  type="text" class="form-control" aria-describedby="emailHelp" value="<?= $_POST["id"] ?? " " ?>" >
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input name="name" id="name"  type="text" class="form-control" aria-describedby="emailHelp" value="<?= $_POST["name"] ?? " " ?>" >
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input name="password" id="password" type="password" class="form-control" >
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-light mb-5 mt-4" style="width: 100%; color: white; background-color: #F2819B">REGISTER</button>
    </div>
</form>
