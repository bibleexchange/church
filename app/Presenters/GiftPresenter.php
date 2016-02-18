<?php namespace Deliverance\Presenters;

class GiftPresenter extends Presenter {

    /**
     * Present a link to the user's gravatar
     *
     * @param int $size
     * @return string
     */
  
    /**
     * @return string
     */
    public function followerCount()
    {
        $count = $this->entity->followers()->count();
        $plural = str_plural('Follower', $count);

        return "{$count} {$plural}";
    }
	
/*
    public function sums($offeringsId = [null])
    {
    
    	$depositInfo->depositSums($depositId,$offeringsId);
    
    	$depositSumsF = array();
    	$depositSumsF['checks'] = number_format($depositInfo->other,2,'.','');
    	$depositSumsF['penny'] = number_format(($depositInfo->penny*.01),2,'.','');
    	$depositSumsF['nickel'] = number_format(($depositInfo->nickel*.05),2,'.','');
    	$depositSumsF['dime'] = number_format(($depositInfo->dime*.10),2,'.','');
    	$depositSumsF['quarter'] = number_format(($depositInfo->quarter*.25),2,'.','');
    	$depositSumsF['halfD'] = number_format(($depositInfo->halfD*.50),2,'.','');
    	$depositSumsF['one'] = number_format(($depositInfo->oneD*1),2,'.','');
    	$depositSumsF['two'] = number_format(($depositInfo->twoD*2),2,'.','');
    	$depositSumsF['five'] = number_format(($depositInfo->fiveD*5),2,'.','');
    	$depositSumsF['ten'] = number_format(($depositInfo->tenD*10),2,'.','');
    	$depositSumsF['twenty'] = number_format(($depositInfo->twentyD*20),2,'.','');
    	$depositSumsF['fifty'] = number_format(($depositInfo->fiftyD*50),2,'.','');
    	$depositSumsF['hundred'] = number_format(($depositInfo->hundredD*100),2,'.','');
    
    	$depositSumsF['cash'] = number_format(($depositSumsF['one'] + $depositSumsF['two'] + $depositSumsF['five'] + $depositSumsF['ten'] + $depositSumsF['twenty'] + $depositSumsF['fifty'] + $depositSumsF['hundred']),2,'.','');
    	$depositSumsF['coins'] = number_format(($depositSumsF['penny'] + $depositSumsF['nickel'] + $depositSumsF['dime'] + $depositSumsF['quarter'] + $depositSumsF['halfD']),2,'.','');
    	$depositSumsF['total'] = number_format(($depositSumsF['checks'] + $depositSumsF['cash'] + $depositSumsF['coins']),2,'.','');
    
    	return $depositSumsF;
    }
    */
}