<?php
namespace App\Repositories;

//Models
use App\User;
use App\Models\Search;
use App\Models\Word;
use App\Models\Translation;

class AzerdictRepostory
{
    public function test(){
        return 'test';
    }
    public function grab($searching_word){
        //$searching_word = 'test';
        $url = 'https://azerdict.com/english/'.$searching_word;
        $data = file_get_contents($url);

        //print_r($data);
        libxml_use_internal_errors(true);

        $dom = new \DomDocument();
        $dom->loadHTML($data);

        //$dom->getElementsByTagName('a')
        $finder = new \DomXPath($dom);
        $classname="result-table";
        $nodes = $finder->query("//*[contains(@class, '$classname')]");


//        echo '<pre>';
//        print_r($nodes[0]->getElementsByTagName('tr')[1]);
//        echo '</pre>';

        $response = array();
        foreach($nodes as $element) {

            $first_row_of_table = $element->getElementsByTagName('tr')[0];
            $language_name = $first_row_of_table->getElementsByTagName('th')[0];
            //dd($language_name->nodeValue);
            $first_tr = $element->getElementsByTagName('tr')[1];
            $first_td_of_first_tr = $first_tr->getElementsByTagName('td')[0];

            //trim() elemek lazimdir cunki bezen bosluq(space) olur icinde
            //eger table-nin 2-ci setrinin 1-ci columnun deyeri axtarial soze beraberdise. 1-ci setrde table column name olur deye 2-ci setr goturulur.
            //table th icinde tablenin language name0i yazilir onu da yoxlamaq lazimdir. cunki bezi sozler hem az dilinde ver hem en, meselen car sozu.
            if (trim($language_name->nodeValue) == "English" && trim($first_td_of_first_tr->nodeValue) == $searching_word) {
                foreach($element->getElementsByTagName('tr') as $tr){
                    if ($tr->getElementsByTagName('td')->length > 0 ){
                        $data = array();
                        $data['word'] = trim($tr->getElementsByTagName('td')[0]->nodeValue);
                        $data['translation'] = trim($tr->getElementsByTagName('td')[1]->nodeValue);
                        $this->saveGrabbedTranslation($data);
                    }
                }
                $response['status'] = true;
                $response['message'] = 'Searchong word found';
            } else {
                $response['status'] = false;
                $response['message'] = 'Searchong word not found in grabbing iperation';
            }
        }

        return $response;
    }

    public function saveGrabbedTranslation($data){
        //dd($data);
        //dd($data['word']);
        $check_word = Word::where('word','=',$data['word'])->first();
        //dd($check_word);

        if ($check_word){
            $word_id = $check_word->id;
        } else {
            $word = new Word;
            $word->word = $data['word'];
            $word->save();

            $word_id = $word->id;
        }

        $check_translation = Translation::where([
            ['word_id','=',$word_id],
            ['translation','=',$data['translation']]
        ])->first();
        //dd($check_translation);

        if ($check_translation == null){
            //dd($check_translation);
            Translation::create([
                'word_id' =>$word_id,
                'translation' => $data['translation']
            ]);
        }
    }
}