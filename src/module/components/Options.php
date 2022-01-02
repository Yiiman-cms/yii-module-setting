<?php


namespace YiiMan\Setting\module\components;


use system\lib\Core;
use YiiMan\YiiLibMeta\lib\MetaLib;
use system\lib\models\OptionsModel;
use YiiMan\Setting\module\models\DynamicModel;
use Yii;
use yii\base\Component;

/**
 * Class Options
 * @package YiiMan\Setting\module\components
 * @property         $emailServer
 * @property string $URL
 * @property         $bot
 * @property         $logoB64
 *                   base64
 * @property         $siteTitle
 * @property         $language
 * @property         $emailUsername
 * @property         $emailPassword
 * @property         $emailPort
 * @property         $emailPortNoSSL
 * @property         $emailServerSSL
 * @property         $emailEncryptionMode
 * @property         $BackendUrl
 * @property         $GoogleAnalytics
 * @property         $emailAfterRegisterStatus
 *
 * @property         $HomeDetailsAgencyLimitShow
 *
 * @property         $SelectedMap
 *
 * @property         $bedroom                                                           int
 * @property         $mapKey
 * @property         $cedarmapKey
 * @property         $priceUnit
 * @property         $prepaymentPercent
 * @property         $HomeCardLimit
 *
 * @property         $HomeVipCardLimit
 *
 * @property         $roundPrice
 * @property         $adminSubmitHomeStatus
 *
 * @property         $firmSubmitHomeStatus
 *
 * @property         $usersSubmitHomeStatus
 *
 * @property         $DealsInHomePage
 *
 * @property         $DealsInVIPHomePage
 *
 * @property         $OrderHomeUpSideCards
 *
 * @property         $OrderHomeVipCards
 *
 * @property         $HomeVipH1
 *
 * @property         $HomeVipH2
 *
 * @property         $FrontendCustomCss
 *
 * @property         $FrontendCustomJs
 *
 * @property         $HomeDescriptionStatus
 *
 * @property         $HomeDescriptionH1
 *
 * @property         $HomeDescriptionP
 *
 * @property         $HomeHeaderStatus
 *
 * @property         $HomeHeaderH1
 * @property         $HomeHeaderP
 * @property         $searchResultLimit
 *
 * @property         $MeterPriceMode
 *
 * @property         $HomeDetailSuggestions
 *
 * @property         $HomeResentH1
 *
 * @property         $HomeResentH2
 *
 * @property         $HomeResentsStatus
 *
 * @property         $HomeResentResultLimit
 *
 * @property         $HomeNewsStatus
 *
 * @property         $AgenciesResultLimit
 *
 * @property         $AgencyPhoneModalList
 *
 * @property         $AgentCallDetailTextPosition
 *
 * @property         $PayToken
 *
 * @property         $homeRequestStatus
 *
 * @property         $ByePlanText
 * @property string $neshanMapKey
 *
 * @property  string $phone
 * @property string $address
 * @property string $email
 * @property string $arvanCloud_token
 * @property string $cloudFlare_token
 * @property string $cloudFlare_email
 * @property string $CanSeeAgencies_homeAddressesWithoutPlan
 *
 * @property string $homeDescriptionStatus
 *
 * @property string $sendRequestText
 * @property string $UploadDir
 * @property string $smsAPI
 * @property string $SMSLine
 * @property string $UploadUrl
 * @property string $telegramToken
 * @property string $telegramBotUsername
 */
class Options extends Component
{
    public $object;
    public $fileName = 'settings.json';

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        $this->getObject();
    }

    public function set($key, $object = '')
    {

        $this->getObject();

        $fileContent = $this->object;

        if (!empty($fileContent)) {

            $content = $fileContent;


            if (!empty($content)) {
                if (is_object($object) || is_array($object)) {
                    $content->{$key} = $object;
                } else {
                    if (is_string($object)) {
                        $object = trim($object);
                    }
                    $content->{$key} = $object;
                }
                if (!class_exists(MetaLib::class)) {
                    $content = json_encode($content, JSON_PRETTY_PRINT);
                }
                $this->writeFile($content);
            } else {
                $content = [];
                if (is_object($object) || is_array($object)) {
                    $content->{$key} = json_encode($object, JSON_PRETTY_PRINT);
                } else {
                    $content->{$key} = $object;
                }
                if (!class_exists(MetaLib::class)) {
                    $content = json_encode($content, JSON_PRETTY_PRINT);
                }
                $this->writeFile($content);
            }
        } else {
            $content = [];
            if (is_object($object) || is_array($object)) {

                $content[$key] = json_encode($object, JSON_PRETTY_PRINT);
            } else {
                $content[$key] = $object;
            }
            if (!class_exists(MetaLib::class)) {
                $content = json_encode($content, JSON_PRETTY_PRINT);
            }
            $this->writeFile($content);
        }

    }

    private function writeFile($content)
    {
        Yii::$app->MetaLib->set('settings', $content, 1, true);
        return;
    }

    public function remove($key)
    {
        $file = realpath(__DIR__ . '/../' . $this->fileName);
        if ($file) {
            $fileContent = file_get_contents($file);
            if (!empty($fileContent)) {
                $content = json_decode($fileContent);
                if (!empty($content)) {
                    unset($content->{$key});
                    $content = json_encode($content, JSON_PRETTY_PRINT);
                    $file = fopen($file, 'w+');
                    fwrite($file, $content);
                    fclose($file);

                }
            }
        }
    }

    public function getObject()
    {

        $options = Yii::$app->MetaLib->get('settings', 1);
        if (!empty($options)) {

            $this->object = $options->content;

            return;
        }


    }

    public function getFileFit($file,$size){
        if (!empty($this->object->DynamicModel->{$file}->type) && $this->object->DynamicModel->{$file}->type == 'file') {


            return Yii::$app->UploadManager->getFit('DynamicModel', $this->object->DynamicModel->{$file}->file,$size);
        }
    }

    public function getFileWithDPI($file,$dpi){
        if (!empty($this->object->DynamicModel->{$file}->type) && $this->object->DynamicModel->{$file}->type == 'file') {
            $model = new DynamicModel();
            $model->defineAttribute($file, '');
            $model->{$file} = $this->object->DynamicModel->{$file}->file;

            return Yii::$app->UploadManager->changeResolution('DynamicModel/'.$this->object->DynamicModel->{$file}->file, $dpi);
        }
    }

    public function getFileResized($file,$size){
        if (!empty($this->object->DynamicModel->{$file}->type) && $this->object->DynamicModel->{$file}->type == 'file') {
            $model = new DynamicModel();
            $model->defineAttribute($file, '');
            $model->{$file} = $this->object->DynamicModel->{$file}->file;
            return Yii::$app->UploadManager->getResizedUrl('DynamicModel',$this->object->DynamicModel->{$file}->file,$size);
        }
    }

    public function __get($name)
    {
        switch ($name) {
            case 'UploadDir';
                return Core::$uploadDir;
                break;
            case 'UploadUrl':
                return Core::$uploadURL;
                break;
            case 'URL':
                return Core::$SiteURL;
                break;
            case 'BackendUrl':
                return Core::$SiteAdminURL;
                break;

        }
        if (!empty($this->object)) {

            if (!empty($this->object->{$name}) && $this->object->{$name} != 'filoc') {
                /* < Object > */
                {
                    $out = json_decode($this->object->{$name});
                    if (!empty($out)) {
                        if (!empty($out->type) && $out->type == 'file') {
                            return $out->file;
                        } else {
                            return $out;
                        }
                    } else if (!empty($this->object->{$name})) {
                        return $this->object->{$name};
                    } else {
                        return null;
                    }
                }
                /* </ Object > */
            } else {
                global $details;
                if (!empty($details['Options'][$name])) {


                    return $details['Options'][$name];
                } else if (!empty($this->object->DynamicModel->{$name})) {

                    /* < Object > */
                    {


                        if (!empty($this->object->DynamicModel->{$name}->type) && $this->object->DynamicModel->{$name}->type == 'file') {
                            $model = new DynamicModel();
                            $model->defineAttribute($name, '');
                            $model->{$name} = $this->object->DynamicModel->{$name}->file;

                            return Yii::$app->UploadManager->getImageUrl($model, $name);
                        }

                        return $this->object->DynamicModel->{$name};

                    }
                    /* </ Object > */
                } else {
                    /* < file > */
                    {
                        $file = $this->getfile($name);
                        if (!empty($file)) {

                            return $file;
                        }
                    }
                    /* </ file > */
                }
            }
        }

        return '';
    }

    public function __isset($name)
    {
        return $this->__get($name);
    }

    public function __set($name, $value)
    {
        return $this->set($name, $value);
    }

    protected function getfile($fileName)
    {

        $path = __DIR__ . '/../files/' . $fileName . '.base64';

        if (file_exists($path)) {

            $content = file_get_contents($path);

            return $content;
        }
    }
}
	
	
