<?php

namespace App\Http\Middleware;

use Closure;
use Nette\Mail\Message;
use Nette\Mail\SmtpMailer;

class EmailMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $mail = new Message;
        $mail->setFrom('lee <leechichuang@163.com>')
            ->addTo('969621150@qq.com')
            ->setSubject('Order Confirmation')
            ->setBody("Hello, Your order has been accepted.");
            $mailer = new SmtpMailer([
            'host' => 'smtp.163.com',
            'username' => 'leechichuang@163.com',
            'password' => 'lee@undefined',

            ]);
        $mailer->send($mail);
        return $next($request);
    }
}
