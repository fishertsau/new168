@extends('frontend.components.topHeading.topHeading')


@section('heading_content')
    @include('frontend.components.deviceSearch.deviceSearchBlock')
@endsection

@section('heading_addition')
    <div class="gearSearchMoreTerm" v-show="view_control.see_more_term" v-cloak>
        <div class="full-width gearSearchMoreTerm__heading visible-desktop-block">
            <h5 class="title-danger zero-margin rwd-text-24">更多搜尋條件
                <span class="text-danger pull-right rwd-text-24"
                @click="hide_see_more_term">[關閉 x]
                </span>
            </h5>
        </div>

        <div class="row">
            使用場合
            <div class="col-md-3 col-xs-12 gearSearchMoreTerm__blk">

                <h5 class="text-warning rwd-text-24">場合(最多三個)
                    <span class="text-danger" @click="unset_query_occasions">[重設]</span>
                </h5>
                <occasions :list="queryList.occasion_list"
                           :occasions="queryTerm.occasions">
                </occasions>
            </div>

            設備價格
            <div class="col-md-3 col-xs-12 gearSearchMoreTerm__blk">
                <h5 class="text-warning rwd-text-24">價格
                    <span class="text-danger" @click="unset_query_price_range">[重設]</span>
                </h5>
                <price_ranges :list="queryList.price_range_list"
                              :chosen_price_range.sync="queryTerm.price_range">
                </price_ranges>
            </div>
            <div class="clearfix visible-md-block"></div>
            常用規格
            <div class="col-md-3 col-xs-12 gearSearchMoreTerm__blk">
                <h5 class="text-warning rwd-text-24">常用規格
                    <span class="text-danger" @click="unset_query_spec">[重設]</span>
                </h5>
                <table class="full-width">
                    <thead>
                    <tr>
                        <th style="width: 25%"></th>
                        <th style="width: 75%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-center rwd-text-24 vertical-top">瓦斯</td>
                        <td>
                        <span v-for="item in queryList.spec_list[0].item_list">
                            <input type="radio"
                                   class="queryTerm-checkbox queryTerm-spec"
                                   name="queryTerm_gas_type"
                                   v-model="queryTerm.spec.gas_type"
                                   value="@{{ item }}">
                            <span class="rwd-text-24">@{{ item }}</span>
                            <br>
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center rwd-text-24 vertical-top">電壓</td>
                        <td>
                        <span v-for="item in queryList.spec_list[1].item_list">
                            <input type="radio"
                                   class="queryTerm-checkbox queryTerm-spec"
                                   name="queryTerm_voltage"
                                   v-model="queryTerm.spec.voltage"
                                   value="@{{ item }}">
                            <span class="rwd-text-24">@{{ item }}</span>
                            <br>
                        </span>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>

            賣方位置
            <div class="col-md-3 col-xs-12 gearSearchMoreTerm__blk">
                <h5 class="text-warning rwd-text-24">賣方位置 (最多三個)
                    <span class="text-danger" @click="unset_query_city">[重設]</span>
                </h5>
                <districts :districts="queryList.city"
                           :selected_city.sync="queryTerm.selected_city">
                </districts>
            <span v-for="area in queryTerm.selected_city.areas"
                  class="text-warning">
                @{{ area.title }}
            </span>
            </div>
        </div>
    </div>
@endsection


