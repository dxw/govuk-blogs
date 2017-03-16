<?php
$showBanner = get_field('show_banner', 'options');
if ($showBanner === true) {
    ?>
    <div id="user-satisfaction-survey-container" class="container">
      <section id="user-satisfaction-survey" class="visible" aria-hidden="false">
        <div class="row">
            <div class="span10">
                 <h2>Tell us what you think of GOV.UK</h2>
                  <p><a href="https://www.surveymonkey.com/s/2MRDLTW?c=/government/consultations/retail-exits-reform-draft-regulations" target="_blank">Take the 3 minute survey</a> This will open a short survey on another website</p>
            </div>
            <div class="span2">
                <p><a href="#survey-no-thanks" id="survey-no-thanks">No thanks</a></p>
            </div>
        </div>
      </section>
    </div>
    <?php
}
?>
