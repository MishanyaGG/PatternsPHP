<?php

namespace Data;

class ChatRoom implements ChatRoomMediatorInterface{
    public function showMessage(User $user, $message)
    {
        $time = date('M d, y H:i');
        $sender = $user->getName();

        echo $time . ' ['. $sender . ']: ' . $message;
    }
}
