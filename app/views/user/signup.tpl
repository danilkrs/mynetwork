{include(file='../template/header.tpl')}
<div class="container">
  <div class="row"> 
    <div class="col-md-8">
      <div class="signin-banner">
        <p>Welcome to my dark local network</p>
      </div>
    </div>
    <div class="col-md-4">
      <form action="?controller=user&action=signUp" method="POST">
        <div class="form-group">
          <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{if !empty($user.name) }{$user.name}{/if}" />
        </div>
        {if !empty($errors.name)}
          <div class="error-block">
            <div class="validation-error-triangle"></div>
            <div class="validation-error">
              <p>{$errors.name}</p>
            </div>
          </div>
        {/if}
        <div class="form-group">
          <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{if !empty($user.email) }{$user.email}{/if}" />
        </div>
        {if !empty($errors.email)}
          <div class="error-block">
            <div class="validation-error-triangle"></div>
            <div class="validation-error">
              <p>{$errors.email}</p>
            </div>
          </div>
        {/if}
        {if !empty($errors.emailExist)}
          <div class="error-block">
            <div class="validation-error-triangle"></div>
            <div class="validation-error">
              <p>{$errors.emailExist}</p>
            </div>
          </div>
        {/if}

        <div class="form-group">
          <input type="password" class="form-control" id="pass" name="password" placeholder="Password">
        </div>
         {if !empty($errors.password)}
          <div class="error-block">
            <div class="validation-error-triangle"></div>
            <div class="validation-error">
              <p>{$errors.password}</p>
            </div>
          </div>
        {/if}
        <div class="form-group">
          <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Try password">
        </div>
        {if !empty($errors.password_confirm)}
          <div class="error-block">
            <div class="validation-error-triangle"></div>
            <div class="validation-error">
                <p>{$errors.password_confirm}</p>
            </div>
          </div>
        {/if}
        <button type="submit" class="btn btn-default btn-primary" style="background: black">Sign up</button>
        <a href="?controller=user&action=signIn" class="btn btn-default ">Sing in</a>
      </form>
    </div>
  </div>
</div>
{include(file='../template/footer.tpl')}
