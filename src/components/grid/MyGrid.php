<?php

namespace app\components\grid;

use yii\grid\Column;
use yii\grid\GridView;
use yii\helpers\Html;

class MyGrid extends GridView
{

    public ?string $myHeader = null;
    /**
     * @var string the layout that determines how different sections of the grid view should be organized.
     * The following tokens will be replaced with the corresponding section contents:
     *
     * - `{summary}`: the summary section. See [[renderSummary()]].
     * - `{errors}`: the filter model error summary. See [[renderErrors()]].
     * - `{items}`: the list items. See [[renderItems()]].
     * - `{sorter}`: the sorter. See [[renderSorter()]].
     * - `{pager}`: the pager. See [[renderPager()]].
     */
    public $layout = "{summary}\n{items}\n{pager}";

    /**
     * {@inheritdoc}
     */
    public function renderSection($name)
    {
        return match ($name) {
            '{errors}' => $this->renderErrors(),
//            '{header}' => $this->renderTableHeader(),
            default => parent::renderSection($name),
        };
    }

    /**
     * Renders the table header.
     * @return string the rendering result.
     */
    public function renderTableHeader()
    {
        if ($this->myHeader === null) {
            $cells = [];
            foreach ($this->columns as $column) {
                /* @var $column Column */
                $cells[] = $column->renderHeaderCell();
            }
            $content = Html::tag('tr', implode('', $cells), $this->headerRowOptions);
            if ($this->filterPosition === self::FILTER_POS_HEADER) {
                $content = $this->renderFilters() . $content;
            } elseif ($this->filterPosition === self::FILTER_POS_BODY) {
                $content .= $this->renderFilters();
            }
        }

        return "<thead>\n" . $this->myHeader . "\n</thead>";
    }
}
