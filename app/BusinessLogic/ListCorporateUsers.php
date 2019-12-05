<?php 
namespace App\BusinessLogic;
use App\BusinessLogic\CommonBusinessLogic;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Config;


class ListCorporateUsers extends CommonBusinessLogic{

    public function action(){
        $actions  = Config::get('actionlist.listCorporateUsers.function');
        $this->runFunc($actions);
    }

    public function listUserTransactions(){
        return Transactions::where([
            ['UserId', $this->mainObject->request['User']->UserID],
            ['Status', 'Success'],
        ])->orderBy('TransactionId', 'DESC')->paginate(5);
                
    }

    public function listAll(){
        $corporates = DB::table(Config::get('tables.corporates').' AS t1')
        ->join(Config::get('tables.users').' AS t2', 't1.CorporateUserId', '=', 't2.UserID')
        ->select(['t1.CorporateId', 't1.CorporateUserId', 't2.MobileNumber', 't2.EmailId', 't2.Name' ,'t1.UserRole', 't1.MaximumBookingAmount', 't1.CreatedOnDate', 't1.IsActive', 't2.CountryCode'])
        ->where('t1.UserId', $this->mainObject->request['User']->UserID)
        ->orderBy('t1.CorporateId', 'desc')->paginate(5)->toArray();
        $this->mainObject->actionList['corporate_users'] = $corporates['data'];
        
    }
   
}