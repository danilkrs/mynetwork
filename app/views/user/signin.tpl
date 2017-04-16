{include(file='../template/header.tpl')}
<div class="container">
  <div class="row">
    <div class="col-md-8">
      <div class="signin-banner">
        <p>Welcome to my dark local network</p>
      </div>
    </div>
    <div class="col-md-4">
      <h4 class="text-center">For the first time on mynetwork?</h4>
      <div class="form-group">
          <a href="?controller=user&action=signUp" class="btn btn-default btn-block">Sing Up For Free</a>
      </div>
      <form action="?controller=user&action=signIn" method="POST">
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
        {if !empty($errors.signInError)}
          <div class="error-block">
            <div class="validation-error-triangle"></div>
            <div class="validation-error">
              <p>{$errors.signInError}</p>
            </div>
          </div>
        {/if}
        <div class="form-group">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password"/>
        </div>
        {if !empty($errors.password)}
          <div class="error-block">
            <div class="validation-error-triangle"></div>
            <div class="validation-error">
              <p>{$errors.password}</p>
            </div>
          </div>
        {/if}
        <button type="submit" class="btn btn-default btn-primary btn-block">Sign in</button>
      </form>
    </div>
  </div>
</div>
{include(file='../template/footer.tpl')}
