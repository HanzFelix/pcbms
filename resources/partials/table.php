<?php
function generateTable($data, $headerLabels)
{
    $html = '<table class="text-left rounded-md overflow-hidden w-full">';

    // Generate table header
    $html .= '<thead class="bg-accent bg-opacity-75 text-white border-primary">';
    $html .= '<tr>';
    foreach ($headerLabels as $label) {
        $html .= '<th class="px-4 py-2">' . htmlspecialchars($label) . '</th>';
    }
    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';
    $i = 0;
    foreach ($data as $row) {
        $html .= '<tr class="bg-accent ' . ($i % 2 == 0 ? 'bg-opacity-10' : 'bg-opacity-25') . '">';
        foreach ($row as $cell) {
            $html .= '<td class="px-4 py-2">' . $cell . '</td>';
        }
        $html .= '</tr>';
        $i++;
    }
    $html .= '</tbody>';
    $html .= '</table>';

    return $html;
}
