<?php

namespace MessengerBundle\Tests\Entity;

use MessengerBundle\Entity\Notification;
use MessengerBundle\Tests\Fixtures\Recipient\DoctrineRecipient;

/**
 * @author Yann Eugoné <yann.eugone@gmail.com>
 */
class NotificationTest extends \PHPUnit_Framework_TestCase
{
    public function testPropertiesAssignment()
    {
        $notification = new Notification(
            'subject',
            'body',
            new DoctrineRecipient(1)
        );

        $this->assertSame(null, $notification->getId());
        $this->assertSame('subject', $notification->getSubject());
        $this->assertSame('body', $notification->getBody());
        $this->assertSame(DoctrineRecipient::class, $notification->getRecipientClass());
        $this->assertSame(1, $notification->getRecipientId());
        $this->assertInstanceOf(\DateTime::class, $notification->getRecordedAt());

        $this->assertNull(null, $notification->getDeliveredAt());
        $this->assertFalse($notification->isDelivered());
        $notification->setDelivered();
        $this->assertInstanceOf(\DateTime::class, $notification->getDeliveredAt());
        $this->assertTrue($notification->isDelivered());
    }

    public function testImmutability()
    {
        $notification = new Notification(
            'subject',
            'body',
            new DoctrineRecipient(1)
        );

        $notification->setDelivered();
        $date = $notification->getDeliveredAt();
        $notification->setDelivered();
        $this->assertSame($date, $notification->getDeliveredAt());
    }
}
