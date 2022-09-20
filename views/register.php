<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
    <h2>Register Form</h2>
    <form action="" method="post" class="form">
        <div class="form-field">
            <div class="form-label">
                <label for="email">Email <span class="field-required">*</span></label>
            </div>
            <div class="form-input">
                <input type="email" id="email" name="email" value="<?= $user->email ?? '' ?>" >
            </div>
        </div>
        <div class="form-field">
            <div class="form-label">
                <label for="name">Name <span class="field-required">*</span></label>
            </div>
            <div class="form-input">
                <input type="text" id="name" name="name" value="<?= $user->name ?? '' ?>" >
            </div>
        </div>
        <div class="form-field">
            <div class="form-label">
                <label for="password">Password <span class="field-required">*</span></label>
            </div>
            <div class="form-input">
                <input type="password" id="password" name="password" value="<?= $user->password ?? '' ?>" >
            </div>
        </div>
        <div class="form-field">
            <div class="form-error">
                <?php
                    if (!isset($errors)){

                    }
                    else if (count($errors) > 0){
                        echo $errors[0];
                    }else{
                        echo 'Successful';
                    }
                ?>
            </div>
        </div>
        <div class="form-field register">
            <input type="submit" value="Register">
        </div>
    </form>
</body>
</html>