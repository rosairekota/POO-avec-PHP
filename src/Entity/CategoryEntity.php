<?

namespace App\Entity;

use Core\Entity\Entity;

class CategoryEntity extends Entity
{
    public function getURL()
    {
        return 'index.php?p=category&id=' . $this->id;
    }

    public function getExtrait()
    {
        $content = substr(nl2br($this->description), $start = 0, $end = 50);
        $html = $content . '...<br>';
        $html .= '<a href=' . $this->getURL() . '>Voir la suite</a>';
        return $html;
    }
}
