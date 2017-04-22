<?php


trait AssertDeviceCRUD
{
    private function AssertDeviceDefault($device)
    {
        //control
        $this->assertEquals($device->published, false);

        //basic info
        $this->assertEquals($device->cat_id, 1);
        $this->assertSame($device->title, 'A jack pot vendor');
        $this->assertSame($device->brand, '');
        $this->assertSame($device->model, '');

        //business term
        $this->assertEquals($device->price, 0);
        $this->assertSame($device->price_note, '');
        $this->assertSame($device->transaction, '');
        $this->assertEquals($device->deposit, 0);
        $this->assertSame($device->transportation, '');
        $this->assertEquals($device->freight, 0);

        //device status
        $this->assertEquals($device->is_new, true);
        $this->assertEquals($device->used_time, '');


        //contact info
        $this->assertSame($device->contact_tel, '');
        $this->assertSame($device->contact_role, '');
        $this->assertSame($device->contact_email, '');
        $this->assertSame($device->contact_name, '');
        $this->assertSame($device->contact_line_id, '');

        //introduction
        $this->assertSame($device->description, '');

        //condition & guarantee
        $this->assertSame($device->used_condition, '');
        $this->assertSame($device->guarantee, '');

        //spec + frequent use specs
        $this->assertSame($device->gas_type, '');
        $this->assertSame($device->voltage, '');
        $this->assertSame($device->dimension, ['width' => '', 'height' => '', 'depth' => '']);
        $this->assertNull($device->specs);

        //location
        $this->assertEquals($device->city, 0);
        $this->assertEquals($device->zip, 0);
        $this->assertEquals($device->street, '');
    }

    private function assertDeviceSetting($device, $input)
    {
        //control
        $this->assertEquals($device->published, $input['published']);

        //basic info
        $this->assertEquals($device->cat_id, $input['cat_id']);
        $this->assertSame($device->title, $input['title']);
        $this->assertSame($device->brand, $input['brand']);
        $this->assertSame($device->model, $input['model']);


        //business term
        $this->assertEquals($device->price, $input['price']);
        $this->assertSame($device->price_note, $input['price_note']);
        $this->assertSame($device->transaction, $input['transaction']);
        $this->assertEquals($device->deposit, $input['deposit']);
        $this->assertSame($device->transportation, $input['transportation']);
        $this->assertEquals($device->freight, $input['freight']);

        //device status
        $this->assertEquals($device->is_new, $input['is_new']);
        $this->assertEquals($device->used_time, $input['used_time']);


        //contact info
        $this->assertSame($device->contact_tel, $input['contact_tel']);
        $this->assertSame($device->contact_role, $input['contact_role']);
        $this->assertSame($device->contact_email, $input['contact_email']);
        $this->assertSame($device->contact_name, $input['contact_name']);
        $this->assertSame($device->contact_line_id, $input['contact_line_id']);

        //introduction
        $this->assertSame($device->description, $input['description']);

        //condition & guarantee
        $this->assertSame($device->used_condition, $input['used_condition']);
        $this->assertSame($device->guarantee, $input['guarantee']);

        //spec + frequent use specs
        $this->assertSame($device->gas_type, $input['gas_type']);
        $this->assertSame($device->voltage, $input['voltage']);
        $this->assertSame($device->dimension, $input['dimension']);


        //location
        $this->assertEquals($device->city, $input['city']);
        $this->assertEquals($device->zip, $input['zip']);
        $this->assertEquals($device->street, $input['street']);

    }
}