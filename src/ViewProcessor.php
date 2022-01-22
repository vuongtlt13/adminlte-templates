<?php

namespace Vuongdq\AdminLTETemplates;
use Illuminate\Console\Command;
use Vuongdq\VLAdminTool\Common\CommandData;
use Vuongdq\VLAdminTool\Utils\FileUtil;
use Illuminate\Console\Concerns\InteractsWithIO;

class ViewProcessor extends Command {
    private $apiMode = false;
    private $force = false;
    private $templateType = "";

    /** @var CommandData */
    private $commandData;

    public function generateLayout(bool $isAPIMode = false, bool $force = false, CommandData $commandData) {
        if (!$isAPIMode) {
            $this->apiMode = $isAPIMode;
            $this->force = $force;
            $this->commandData = $commandData;
            $this->templateType = "adminlte-templates";
            $this->copyView();
            $this->publishPublicFiles();
        }
    }

    private function copyView()
    {
        $viewsPath = config('vl_admin_tool.path.views', resource_path('views/'));
        $rootPath = dirname(__FILE__, 2);

        $this->createDirectories($viewsPath);

        $files = $this->getLocaleViews();

        foreach ($files as $stub => $blade) {
            $sourceFile = $rootPath . "/templates/" . $stub . ".stub";
            $destinationFile = $viewsPath.$blade;
            $this->publishFile($sourceFile, $destinationFile, $blade);
        }
    }

    public function publishFile($sourceFile, $destinationFile, $fileName)
    {
        if (file_exists($destinationFile) && !$this->confirmOverwrite($destinationFile)) {
            return;
        }

        copy($sourceFile, $destinationFile);
    }

    /**
     * @param $fileName
     * @param string $prompt
     *
     * @return bool
     */
    protected function confirmOverwrite($fileName, string $prompt = ''): bool
    {
        return $this->force;
    }

    private function publishPublicFiles()
    {
        $publicPath = public_path();

        $tempaltePublicDir = get_templates_package_path($this->templateType) . "/public";

        $files = array_diff(scandir($tempaltePublicDir), array('.', '..'));
        foreach ($files as $fileOrFolder) {
            $sourcePath = FileUtil::joinPath($tempaltePublicDir, $fileOrFolder);
            if (is_file($sourcePath)) {
                FileUtil::copyFile($tempaltePublicDir, $fileOrFolder, $publicPath, true);
            } elseif (is_dir($sourcePath)) {
                FileUtil::copyDirectory($sourcePath, FileUtil::joinPath($publicPath, $fileOrFolder), true);
            }
        }
    }

    private function createDirectories($viewsPath)
    {
        FileUtil::createDirectoryIfNotExist($viewsPath.'layouts');
        FileUtil::createDirectoryIfNotExist($viewsPath.'auth');

        FileUtil::createDirectoryIfNotExist($viewsPath.'auth/passwords');
        FileUtil::createDirectoryIfNotExist($viewsPath.'auth/emails');
    }

    private function getLocaleViews()
    {
        return [
            'layouts/app'        => 'layouts/app.blade.php',
            'layouts/auth'        => 'layouts/auth.blade.php',
            'layouts/sidebar'    => 'layouts/sidebar.blade.php',
            'layouts/navbar'    => 'layouts/navbar.blade.php',
            'layouts/datatables_css'    => 'layouts/datatables_css.blade.php',
            'layouts/datatables_js'     => 'layouts/datatables_js.blade.php',
            'layouts/menu'              => 'layouts/menu.blade.php',
            'layouts/home'              => 'home.blade.php',
            'auth/login'         => 'auth/login.blade.php',
            'auth/register'      => 'auth/register.blade.php',
            'auth/email'         => 'auth/passwords/email.blade.php',
            'auth/reset'         => 'auth/passwords/reset.blade.php',
            'emails/password'    => 'auth/emails/password.blade.php',
        ];
    }
}
