<?php switch($type):
    case (1): ?>
    <svg width="32" height="32">
        <circle cx="16" cy="16" r="16" stroke="black" stroke-width="0" fill="<?php echo e($color); ?>"></circle>
        <text x="5" y="22"  style="fill:black;font-size: 16px"><?php echo e($nameTag); ?></text>
        <?php break; ?>
    <?php case (2): ?>
    
    <svg width="32" height="32">
        <rect x="0" y="0" rx="5" ry="5" width="32" height="32" fill="<?php echo e($color); ?>" style="stroke-width:0;"></rect>
        <text x="5" y="22" style="fill:black;font-size: 16px"><?php echo e($nameTag); ?></text>

        <?php break; ?>
    <?php case (3): ?>
    
    <svg width="32" height="32">
        <polygon points="16,0 0.78309703188832,11.055724111756 6.5954291951265,28.944266992616 25.404553884384,28.944279286068 	31.216909431155,11.055744002985 " fill="<?php echo e($color); ?>" style="stroke:purple;stroke-width:0;"></polygon>
        <text x="5" y="22" style="fill:black;font-size: 16px"><?php echo e($nameTag); ?></text>

        <?php break; ?>
    <?php case (4): ?>
    
    <svg width="32" height="32" >
        <polygon points="8.000001509401,2.143592667996 8.5442763975152E-13,15.999994771282 7.9999924529963,29.856402103284 23.999989434191,29.856412560718 	31.999999999992,16.000015686155 24.000016603405,2.1436031254426 "  fill="<?php echo e($color); ?>" style="stroke:purple;stroke-width:0;"></polygon>
        <text x="5" y="22" style="fill:black;font-size: 16px"><?php echo e($nameTag); ?></text>

        <?php break; ?>
    <?php case (5): ?>
    
    <svg width="32" height="32">
        <polygon points="8.5442763975152E-13,15.999994771282 15.999989542563,31.999999999997 31.999999999992,16.000015686155 	16.000020914873,1.3669065879185E-11 " fill="<?php echo e($color); ?>" stroke-width="0"></polygon>
        <text x="5" y="22" style="fill:black;font-size: 16px"><?php echo e($nameTag); ?></text>

        <?php break; ?>
<?php endswitch; ?>
    <?php switch($roleID):
        case (1): ?>
            <circle cx="28" cy="4" r="3" stroke="black" stroke-width="0" fill="black"></circle>
            <rect height="8" width="2" x="27" y="0" fill="black"></rect>
            <polygon points="25.145898644316,1.1974823013079 24.145898266966,2.9295328910135 30.854099523987,6.802519564103 31.854101033387,5.0704696279878 " fill = "black" stroke-width="0"></polygon>
            <polygon points="24.14589756732,5.0704645899847 25.14589681262,6.8025158332799 31.854103132324,2.9295379290175 30.854105019076,1.1974860321334 " fill = "black" stroke-width="0"></polygon>
            <?php break; ?>
        <?php case (2): ?>
            <polygon points="28,0 25.648857298782,7.2360667481539 31.804227357789,2.7639360007462 24.195775873739,2.7639260551337 30.35113424097,7.2360728948744 " fill = "black" stroke-width="0"></polygon>
            <?php break; ?>
        <?php case (4): ?>
            <circle cx="28" cy="4" r="4" stroke="black" stroke-width="0" fill = "black"></circle>
            <?php break; ?>
    <?php endswitch; ?>
</svg>
<?php /**PATH C:\xampp\htdocs\taskOriented\resources\views/components/user-avatar.blade.php ENDPATH**/ ?>