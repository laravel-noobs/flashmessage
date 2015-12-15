<?php namespace KouTsuneka\FlashMessage;

use \Illuminate\Session\SessionManager;

class FlashMessageBuilder {
    /**
     * The session store implementation.
     *
     * @var \Illuminate\Session\SessionManager
     */
    protected $session;

    /**
     * @var string
     */
    protected $flash_key = '_flash';

    /**
     * @param \Illuminate\Session\SessionManager $session
     */
    public function __construct(SessionManager $session)
    {
        $this->session = $session;
    }

    /**
     * @return string
     */
    public function get_key()
    {
        return $this->flash_key;
    }

    /**
     * @param string $key
     */
    public function set_key($key)
    {
        $this->flash_key = $key;
    }

    /**
     * @param string $type
     * @param string $title
     * @param string $message
     * @param array $options
     * @return Message
     */
    public function make($type, $title, $message, $options = [])
    {
        return new Message($type, $title, $message, $options);
    }


    /**
     * @param Message $msg
     * @return FlashMessageBuilder
     */
    public function push_msg(Message $msg)
    {
        $messages = [];
        if($this->session->has($this->flash_key))
            $messages = $this->session->get($this->flash_key);
        array_push($messages, $msg);
        $this->session->flash($this->flash_key, $messages);
        return $this;
    }

    /**
     * @param string $title
     * @param string $message
     * @param string $type
     * @param array $options
     * @return FlashMessageBuilder
     */
    public function push($title, $message, $type = "success", $options = [])
    {
        $this->push_msg($this->make($type, $title, $message, $options));
        return $this;
    }

    /**
     * @return Message[]
     */
    public function get()
    {
        if($this->session->has($this->flash_key));
        {
            $messages = $this->session->get($this->flash_key);
            $this->session->set($this->flash_key, []);
            return $messages;
        }

        return [];
    }
}
