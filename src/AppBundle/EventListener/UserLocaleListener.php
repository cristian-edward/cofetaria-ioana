<?php
/**
 * Created by PhpStorm.
 * User: vali
 * Date: 27.12.2016
 * Time: 17:33
 */

namespace AppBundle\EventListener;


use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

/**
 * Stores the locale of the user in the session after the
 * login. This can be used by the LocaleListener afterwards.
 */
class UserLocaleListener
{
    /**
     * @var Session
     */
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * @param InteractiveLoginEvent $event
     */
    public function onInteractiveLogin(InteractiveLoginEvent $event)
    {
        $user = $event->getAuthenticationToken()->getUser();

        if (null !== $user->getLocale()) {
            $this->session->set('_locale', $user->getLocale());
        }
    }
}