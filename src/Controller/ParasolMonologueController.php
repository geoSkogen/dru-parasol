<?PHP

namespace Drupal\parasol\Controller;

use Drupal\Component\Utility\Html;

/**
*
* @param string $paragraphs
* @param string $phrases
*
*/
class ParasolMonologueController {

  public function generate($paragraphs, $phrases) {
    $config = \Drupal::config('parasol.settings');
    $title = $config->get('parasol.page_title');
    $text = $config->get('parasol.source_text');

    $content_arr = explode('.', $text);
    $element['#source_text'] = [];

    for ($i = 0; $i < $paragraphs; $i++) {
      //error_log('RANDOM PHRASES COUNT:');
      //error_log('Paragraph ' . strval($i));
      $this_paragraph = '';
      $random_phrases = mt_rand( round( $phrases/2 ),$phrases);
      $last_number= 0;
      $next_number = 0;
      //error_log(strval($random_phrases));
      for ($j = 1; $j < $random_phrases; $j++) {
        do {
          $next_number = floor(mt_rand(0, count($content_arr)-1));
        } while ( $next_number===$last_number && count($content_arr) > 1);

        $this_paragraph .= $content_arr[$next_number] . ' ';
        $last_number = $next_number;
      }
      $element['#source_text'][] = Html::escape($this_paragraph);
    }
    $element['#title'] = Html::escape($title);
    $element['#theme'] = 'parasol';

    return $element;
  }
}
?>
