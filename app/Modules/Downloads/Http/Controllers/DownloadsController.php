<?php

namespace App\Modules\Downloads\Http\Controllers;

use App\Modules\Downloads\Download;
use App\Modules\Downloads\Downloadcat;
use Config;
use Contentify\GlobalSearchInterface;
use File;
use FrontController;
use Response;
use URL;

class DownloadsController extends FrontController implements GlobalSearchInterface
{

    public function __construct()
    {
        $this->modelClass = Download::class;

        parent::__construct();
    }

    public function index()
    {
        $perPage = Config::get('app.frontItemsPerPage');

        // NOTE: Add has('downloads') to show only categories that have downloads
        $downloadcats = Downloadcat::paginate($perPage); 

        $this->pageView('downloads::index', compact('downloadcats'));
    }

    /**
     * Show a category
     * 
     * @param  int $id The id of the category
     * @return void
     */
    public function showCategory($id)
    {
        /** @var Downloadcat $downloadcat */
        $downloadcat = Downloadcat::findOrFail($id);

        $downloadcat->access_counter++;
        $downloadcat->save();

        $perPage = Config::get('app.frontItemsPerPage');
        $downloads = Download::whereDownloadcatId($id)->paginate($perPage); 

        $this->title($downloadcat->title);

        $this->pageView('downloads::category', compact('downloadcat', 'downloads'));
    }

    /**
     * Show a download detail page
     * 
     * @param  int $id The id of the download
     * @return void
     */
    public function show($id)
    {
        /** @var Download $download */
        $download = Download::findOrFail($id);

        $this->title($download->title);

        $this->pageView('downloads::show', compact('download'));
    }

    /**
     * Perform a download
     * 
     * @param  int $id The id of the download
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function perform($id)
    {
        /** @var Download $download */
        $download = Download::findOrFail($id);

        $download->access_counter++;
        $download->save();

        $extension = File::extension($download->file);
        $shortName = $download->slug;
        if ($extension) {
            $shortName .= '.'.$extension;
        }
        return Response::download($download->uploadPath(true).$download->file, $shortName);
    }
    
    /**
     * This method is called by the global search (SearchController->postCreate()).
     * Its purpose is to return an array with results for a specific search query.
     * 
     * @param  string $subject The search term
     * @return string[]
     */
    public function globalSearch($subject)
    {
        $downloads = Download::where('title', 'LIKE', '%'.$subject.'%')->get();

        $results = array();
        foreach ($downloads as $download) {
            $results[$download->title] = URL::to('downloads/'.$download->id.'/'.$download->slug);
        }

        return $results;
    }

}