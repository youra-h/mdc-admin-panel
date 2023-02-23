<?php

use yh\mdc\components\Typography;

?>
<h1 class="<?= Typography::headline(1) ?>">Headline 1</h1>
<h2 class="<?= Typography::headline(2) ?>">Headline 2</h2>
<h3 class="<?= Typography::headline(3) ?>">Headline 3</h3>
<h4 class="<?= Typography::headline(4) ?>">Headline 4</h4>
<h5 class="<?= Typography::headline(5) ?>">Headline 5</h5>
<h6 class="<?= Typography::headline(6) ?>">Headline 6</h6>

<h6 class="<?= Typography::subtitle(1) ?>">Subtitle 1</h6>
<h6 class="<?= Typography::subtitle(2) ?>">Subtitle 2</h6>

<p class="<?= Typography::body(1) ?>" style="padding: 10px 0;">Body 1. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.</p>
<p class="<?= Typography::body(2) ?>" style="padding: 10px 0;">Body 2. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. </p>

<p class="<?= Typography::caption() ?>" style="padding: 10px 0;">
    Caption text
</p>
<p class="<?= Typography::button() ?>" style="padding: 10px 0;">
    Button text
</p>
<p class="<?= Typography::overline() ?>" style="padding: 10px 0;">
    Overline text
</p>