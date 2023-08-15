<?php

namespace Data;

interface ChatRoomMediatorInterface{
    public function showMessage(User $user, $message);
}