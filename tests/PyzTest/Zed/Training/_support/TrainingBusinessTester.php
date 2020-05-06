<?php
namespace PyzTest\Zed\Training;

use Pyz\Zed\Training\Business\TrainingFacadeInterface;

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
*/
class TrainingBusinessTester extends \Codeception\Actor
{
    use _generated\TrainingBusinessTesterActions;

   /**
    * Define custom actions here
    */

    /**
     * @return \Pyz\Zed\Training\Business\TrainingFacadeInterface
     */
    public function getTrainingFacade(): TrainingFacadeInterface
    {
        return $this->getLocator()->training()->facade();
    }
}
