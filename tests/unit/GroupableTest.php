<?php

use Acme\Tool\Groupable\Groupable;


use Illuminate\Foundation\Testing\DatabaseTransactions;

class ModelGroup1 extends Groupable
{
}

class ModelGroup2 extends Groupable
{
}

class GroupableTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    function a_group_could_be_inherited()
    {
        $group = new ModelGroup1();

        $this->assertEquals(get_class($group),
            $group->type, "The same class name for Groupable child is expected.");
    }

    /** @test */
    function a_group_member_could_be_added_and_deleted()
    {
        $newGroupMember = [
            'title' => "AAABBB",
            'description' => "des"
        ];

        $group = ModelGroup1::create($newGroupMember);

        $this->seeInDatabase('groups', $newGroupMember);
        $group->delete();
        $this->notSeeInDatabase('groups', $newGroupMember);
    }

    /** @test */
    function a_group_member_could_be_update()
    {
        $newGroupInfo = [
            'title' => "AAABBB",
            'description' => "des"
        ];

        $group = ModelGroup1::create($newGroupInfo);

        $updatedGroupInfo = [
            'title' => "AAABBBCCCDDD",
            'description' => "desAAABBBCCCDDD"
        ];

        $group->update($updatedGroupInfo);

        $this->notSeeInDatabase('groups', $newGroupInfo);
        $this->seeInDatabase('groups', $updatedGroupInfo);
    }

    /** @test */
    function each_member_In_model_group_has_unique_rank()
    {
        $memberNumber = 10;

        for ($i = 1; $i < ($memberNumber + 1); $i++) {
            //given
            $newGroupInfo = [
                'title' => "AABB",
                'description' => "des"
            ];

            //when
            $group = ModelGroup1::create($newGroupInfo);

            //then
            $this->assertEquals($i, $group->rank);
        }

        //then
        $this->assertEquals($memberNumber, $group->memberCount());

        for ($i = 1; $i < ($memberNumber + 1); $i++) {
            //given
            $newGroupInfo = [
                'title' => "AABB",
                'description' => "des"
            ];

            //when
            $group = ModelGroup2::create($newGroupInfo);

            //then
            $this->assertEquals($i, $group->rank);
        }

        $this->assertEquals($memberNumber, $group->memberCount());
    }

    /** @test */
    function all_members_could_be_got()
    {
        $memberNumber = 10;

        for ($i = 1; $i < ($memberNumber + 1); $i++) {
            //given
            $newGroupInfo = [
                'title' => "AABB",
                'description' => "des"
            ];

            //when
            ModelGroup1::create($newGroupInfo);
        }

        //then
        $this->assertCount($memberNumber, ModelGroup1::members());
    }

    /** @test */
    function a_subMember_could_be_added()
    {
        //given
        $newGroupMember = [
            'title' => "AAABBB",
            'description' => "des"
        ];

        $group = ModelGroup1::create($newGroupMember);

        $subMemberInfo = [
            'title' => "submember",
            'description' => "description"
        ];

        //when
        $group->addSubMember($subMemberInfo);

        //then
        $this->seeInDatabase('sub_groups', $subMemberInfo);
    }

    /** @test */
    function each_subMember_has_unique_rank()
    {
        //given
        $newGroupMember = [
            'title' => "AAABBB",
            'description' => "des"
        ];

        $group = ModelGroup1::create($newGroupMember);

        $subMemberNumber = 10;
        $subMemberInfo = [
            'title' => "submember",
            'description' => "description"
        ];

        for ($i = 1; $i < ($subMemberNumber + 1); $i++) {
            //when
            $subGroup = $group->addSubMember($subMemberInfo);

            //then
            $this->assertEquals($i, $subGroup->rank);
        }
    }

    /** @test */
    function a_subMember_is_deleted_cascade_with_member()
    {
        //given
        $newGroupMember = [
            'title' => "AAABBB",
            'description' => "des"
        ];

        $group = ModelGroup1::create($newGroupMember);

        $subMemberInfo = [
            'title' => "submember",
            'description' => "description"
        ];

        //when
        $group->addSubMember($subMemberInfo);
        $this->seeInDatabase('sub_groups', $subMemberInfo);

        $group->delete();
        $this->notSeeInDatabase('sub_groups', $subMemberInfo);
    }
}
