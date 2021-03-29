<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$this->setFrameMode(true);

?>
<form action='<?= $arResult['FORM_ACTION']; ?>'>
    <? foreach ($arResult['HIDDEN'] as $hidden): ?>
        <input
            type='hidden'
            name='<?= $hidden['CONTROL_NAME']; ?>'
            id='<?= $hidden['CONTROL_ID']; ?>'
            value='<?= $hidden['HTML_VALUE']; ?>'
        >
    <? endforeach; ?>
    <? foreach ($arResult['ITEMS'] as $item): ?>
        <? if (empty($item['VALUES']) || isset($item['PRICE'])) {
            continue;
        } ?>
        <div>
            <div><?= $item['NAME']; ?></div>
            <? switch ($item['DISPLAY_TYPE']):
                case 'A': // число от-до, с ползунком
                case 'B': // число от-до ?>
                    <div>
                        <label for='<?= $item['VALUES']['MIN']['CONTROL_ID']; ?>'>
                            <input
                                type='text'
                                name='<?= $item['VALUES']['MIN']['CONTROL_NAME']; ?>'
                                id='<?= $item['VALUES']['MIN']['CONTROL_ID']; ?>'
                                <? if (!empty($item['VALUES']['MIN']['HTML_VALUE'])): ?>
                                    value='<?= $item['VALUES']['MIN']['HTML_VALUE']; ?>'
                                <? endif; ?>
                            >
                        </label>
                        <label for='<?= $item['VALUES']['MAX']['CONTROL_ID']; ?>'>
                            <input
                                type='text'
                                name='<?= $item['VALUES']['MAX']['CONTROL_NAME']; ?>'
                                id='<?= $item['VALUES']['MAX']['CONTROL_ID']; ?>'
                                <? if (!empty($item['VALUES']['MAX']['HTML_VALUE'])): ?>
                                    value='<?= $item['VALUES']['MAX']['HTML_VALUE']; ?>'
                                <? endif; ?>
                            >
                        </label>
                    </div>
                    <? break; ?>
                <? case 'P': // выпадающий список ?>
                <? case 'K': // радиокнопки ?>
                    <div>
                        <? foreach ($item['VALUES'] as $value): ?>
                            <label for='<?= $value['CONTROL_ID']; ?>'>
                                <input
                                    type='radio'
                                    value='<?= $value['HTML_VALUE_ALT']; ?>'
                                    name='<?= $value['CONTROL_NAME_ALT']; ?>'
                                    id='<?= $value['CONTROL_ID']; ?>'
                                    <? if (isset($value['CHECKED']) && $value['CHECKED']): ?>
                                        checked='checked'
                                    <? endif; ?>
                                >
                                <span><?= $value['VALUE']; ?></span>
                            </label>
                        <? endforeach; ?>
                    </div>
                    <? break; ?>
                <? case 'F': // флажки ?>
                    <div>
                        <? foreach ($item['VALUES'] as $value): ?>
                            <label for='<?= $value['CONTROL_ID']; ?>'>
                                <input
                                    type='checkbox'
                                    value='<?= $value['HTML_VALUE']; ?>'
                                    name='<?= $value['CONTROL_NAME']; ?>'
                                    id='<?= $value['CONTROL_ID']; ?>'
                                    <? if (isset($value['CHECKED']) && $value['CHECKED']): ?>
                                        checked='checked'
                                    <? endif; ?>
                                />
                                <span><?= $value['VALUE']; ?></span>
                            </label>
                        <? endforeach; ?>
                    </div>
                    <? break; ?>
                <? endswitch; ?>
        </div>
    <? endforeach; ?>
    <input type='submit' name='set_filter' value='Показать'>
    <input type='submit' name='del_filter' value='Сбросить'>
</form>
