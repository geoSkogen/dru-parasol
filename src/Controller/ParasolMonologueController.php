<?PHP

namespace Drupal\parasol\Controller;

use Drupal\Component\Utility\Html;

class ParasolMonologueController {

  public function initView($paragraphs, $phrases) {
    $config = \Drupal::config('parasol.settings');
    $title = $config->get('parasol.page_title');
    $text = $config->get('parasol.source_text');

    $content_arr = explode('.', $text);
    $element['#source_text'] = [];

    for ($i = 0; $i < $paragraphs; $i++) {
      $this_paragraph = '';
      $random_phrases = mt_rand( round( $phrases/2 ),$phrases);
      $last_number= 0;
      $next_number = 0;

      for ($j = 1; $j < $random_phrases; $j++) {
        do {
          $next_number = floor(mt_rand(0, count($content_arr)-1));
        } while ( $next_number===$last_number && count($content_arr) );

        $this_paragraph .= $content_arr[$next_number] . ' ';
        $last_number = $next_number;
      }
      $element['#source_text'][] = Html::escape($this_paragraph);
    }
    $element['#title'] = Html::escape($page_title);
    $element['#theme'] = 'parasol';

    return $element;
  }
}
?>
