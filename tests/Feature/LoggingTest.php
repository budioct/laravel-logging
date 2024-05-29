<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class LoggingTest extends TestCase
{

    /**
     * Logging Configuration
     * ● Laravel secara default menggunakan file config/logging.php sebagai konfigurasi untuk logging nya
     * ● Saat kita membuat project, secara default, sudah disediakan banyak sekali konfigurasi yang bisa
     *  kita gunakan, namun yang secara default aktif adalah yang sederhana
     *
     * Logging Channel
     * ● Laravel menyediakan beberapa channel (tujuan) log yang bisa kita gunakan, seperti :
     * ● single, mengirim data log ke single file
     * ● daily, mengirim data log ke single file, namun tiap hari akan di rotate file nya
     * ● slack, mengirim data log ke slack chat
     * ● syslog, mengirim data log ke syslog
     * ● null, tidak mengirim data log kemanapun
     * ● stack, mengirim data log ke beberapa channel sekaligus, default nya hanya mengirim ke channel single
     * ● Secara default, Laravel akan menggunakan channel stack
     *
     * Log Facade
     * ● Untuk melakukan logging di Laravel, kita bisa dengan mudah menggunakan Log Facade
     * ● kita tidak perlu manual membuat Logger Monolog lagi
     * ● https://laravel.com/api/9.x/Illuminate/Support/Facades/Log.html
     */

    public function testLogging()
    {

        Log::info("Hello Info");
        Log::warning("Hello Warning");
        Log::error("Hello Error");
        Log::critical("Hello Critical");

        self::assertTrue(true);

        /**
         * result:
         * secara default Logging di laravel menggunakan channel 'stack'
         * nanti hasil log akan di buatkan nama file laravel.log.. di directory ../storage/logs/laravel.logs
         *
         * file: laravel.log
         * [2024-05-29 14:07:30] testing.INFO: Hello Info
         * [2024-05-29 14:07:30] testing.WARNING: Hello Warning
         * [2024-05-29 14:07:30] testing.ERROR: Hello Error
         * [2024-05-29 14:07:30] testing.CRITICAL: Hello Critical
         */

    }


    /**
     * Context
     * ● Kita tahu saat belajar di PHP Logging, di Monolog terdapat fitur bernama Context
     * ● Itu juga bisa kita gunakan di Laravel Logging
     * ● Log Facade memiliki parameter kedua setelah message yang bisa kita isi dengan data context, mirip
     *   seperti yang kita lakukan ketika belajar PHP Logging menggunakan Monolog
     */

    public function testContext()
    {
        Log::info("Hello Context", ["user" => "budhi"]);

        self::assertTrue(true);

        /**
         * result:
         * [2024-05-29 15:58:24] testing.INFO: Hello Context {"user":"budhi"}
         */

    }

    /**
     * With Context
     * ● Atau, kita bisa gunakan function withContext(), yang secara otomatis kode selanjutnya akan
     *   menggunakan context yang kita gunakan dalam withContext()
     * ● Ini sangat cocok ketika misal di Controller kita menambahkan withContext() berisi data user,
     *   sehingga di kode-kode selanjutnya, setiap log akan berisikan informasi siapa user yang melakukan
     *   proses logging tersebut
     */

    public function testWithContext()
    {

        Log::withContext(['user' => 'budhi']);

        Log::info("Hello Info");

        self::assertTrue(true);

        /**
         * result:
         * [2024-05-29 15:59:14] testing.INFO: Hello Info {"user":"budhi"}
         */

    }


    /**
     * Selected Channel
     * ● Secara default, Laravel akan menggunakan logging channel DEFAULT yang sudah dipilih
     * ● Namun, pada kasus tertentu, kita mungkin ingin membuat channel, tapi hanya digunakan ketika
     *   kita mau gunakan
     * ● Laravel juga memiliki fitur menseleksi channel yang ingin digunakan, sehingga sebelum kita kirim
     *   data log, kita bisa pilih channel mana yang akan kita gunakan
     * ● Kita bisa menggunakan method channel(string)
     * ● Return dari method channel() adalah Logger, sehingga kita harus menggunakan Logger tersebut
     *   untuk mengirim ke channel yang kita pilih
     */

    public function testChannel(){

        $slacklogger = Log::channel("slack");
        $slacklogger->error("Hello Error Slack"); // send to slack channel

        Log::info("Hello Laravel"); // send to default channel

        self::assertTrue(true);

        /**
         * result:
         *
         * [2024-05-29 16:05:52] laravel.ERROR: Hello Error Slack
         *
         * [2024-05-29 16:05:52] testing.INFO: Hello Laravel
         */
    }

}
