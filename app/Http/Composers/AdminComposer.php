<?php
namespace App\Http\Composers;
use Illuminate\View\View;

use Request;
use App\articlecategories;
use App\article;
use App\articlecomment;
use App\threadcategories;
use App\communityfeed;
use App\user;
use App\faq;
use App\replies;
/**
 * View composer to provide some param used in admin's sidebar.
 */
class AdminComposer
{
    /**
     * Set up view parameters for the default admin panel.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('articleCount', article::all()->count());
        $view->with('articlecategoryCount', articlecategories::all()->count());
        $view->with('threadCount', communityfeed::all()->count());
        $view->with('faqCount', faq::all()->count());
        $view->with('threadcategoryCount', threadcategories::all()->count());
        $view->with('userCount', user::all()->count());

    }
}
