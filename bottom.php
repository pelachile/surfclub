<div class="row bottom-content">

  <div class="span4 social">
    <h3>Follow Us</h3>
    <div class="row">
      <a class="span2" href="http://www.facebook.com/ExecSurfClub"><p class="circle facebook">F</p><p class="fbody">acebook</p></a>
      <a class="span2" href="http://www.twitter.com/ExecSurfClub"><p class="circle twitter">T</p><p class="fbody">witter</p></a>
    </div>
    <div class="recipes-form span4">
        <h2>Get the Latest</h2>
        <p>Join the mailing list to find out what's happening and who's playing</p>
        <form action="#" id="mailchimp-subscribe">
          <!--[if lt IE 9]> <label for="name">Name </label><![endif]-->
          <input type="text" id="name" name="name" placeholder="Name">
          <span class="help-block">Just give us your first name</span>
          <!--[if lt IE 9]><label for="email">Email</label><![endif]-->
          <input type="text" id="email" name="email" placeholder="Email">
          <span class="help-block">Make sure you use a valid email address</span>
          <button id="subscribe"class="btn btn-warning">Submit</button>
        </form>
      </div>
  </div><!-- end social -->

  <div class="span4 specials-widget">
    <h3>Specials</h3>
    <ul>
      <li>$2 wells every Thursday from 4pm – close. Come get your favorite well drinks and check out the live music in our patio.
      </li>
      <li>Happy hour on all 30 of our cold drafts from around the world 4pm – 7pm daily</li>
      <li>$2 pints on 30 cold drafts from around the world 4pm to close.</li>
    </ul>
  </div><!-- end specials-widget -->

  <div class="span4 social-widget">
    <h3>Find Us</h3>
    <?php if ( is_active_sidebar( 'sidebar1' ) ) : ?>
    <?php dynamic_sidebar( 'sidebar1' ); ?>
    <?php else : ?>
    <!-- This content shows up if there are no widgets defined in the backend. -->
    <div class="help">
      <p>Please activate some Widgets.</p>
    </div><!-- end help -->
    <?php endif; ?>
  </div><!-- end social-widget -->

</div><!-- end bottom-content -->