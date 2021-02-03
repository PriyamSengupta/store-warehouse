<?php
if (!defined('IN_CB')) { die('You are not allowed to access to this page.'); }

$default_value['thickness'] = 35;
$thickness = intval(isset($_POST['thickness']) ? $_POST['thickness'] : $default_value['thickness']);
registerImageKey('thickness', $thickness);
?>
                    <tr>
                        <td><label for="thickness">Thickness</label></td>
                        <td><?php echo getInputTextHtml('thickness', $thickness, array('type' => 'number', 'min' => 50, 'max' => 200, 'step' => 2, 'required' => 'required')); ?></td>
                    </tr>