<!-- The biggest battle is the war against ignorance. - Mustafa Kemal Atatürk -->
<div class="pan-lhs ad-menu-main">
    <div class="ad-menu">
        <ul>
            <li class="ic-db">
                <a href="{{ route('admin.dashboard') }}"
                    class="{{ request()->routeIs('admin.dashboard') ? 's-act' : '' }}">Dashboard</a>
            </li>
            <li class="ic-user">
                {{-- <a href="javascript:void(0);" class="{{ request()->routeIs('admin.user.*') ? 'mact' : '' }}">Users</a> --}}
                <div>
                    <ol>
                        {{-- @foreach ($plans as $plan)
                            <li>
                                <a href="{{ route('admin.user.manage', ['plan' => strtolower($plan->name)]) }}"
                                    class="{{ request()->routeIs('admin.user.manage') && request()->plan == strtolower($plan->name) ? 's-act' : '' }}">{{ $plan->name }}
                                    Users</a>
                            </li>
                        @endforeach --}}
                    </ol>
                </div>
            </li>

            <li class="ic-pay">
                <a href="{{ route('admin.package.index') }}"
                    class="{{ request()->routeIs('admin.package.index') ? 's-act' : '' }}">Package</a>
            </li>
            <li class="ic-pay">
                <a href="{{ route('admin.property-category.index') }}"
                    class="{{ request()->routeIs('admin.property-category.*') ? 's-act' : '' }}">
                    Property Category
                </a>
            </li>

            <li class="ic-pay">
                <a href="{{ route('admin.property-status.index') }}"
                    class="{{ request()->routeIs('admin.property-status.index') ? 's-act' : '' }}">
                    Property List
                </a>
            </li>

            <li class="ic-pay">
                <a href="{{ route('admin.package-order.index') }}"
                    class="{{ request()->routeIs('admin.package-order.index') ? 's-act' : '' }}">
                    Package Order
                </a>
            </li>
            {{-- ic-noti --}}
            <li class="ic-pay">
                <a href="{{ route('admin.payment-package.list') }}"
                    class="{{ request()->routeIs('admin.payment-package.list') ? 's-act' : '' }}">
                    Package Payment
                </a>
            </li>

            <li>
                <h4>Subscriptions</h4>
            </li>
            <li class="ic-pay">
                <a href="{{ route('admin.reserve-property.list') }}"
                    class="{{ request()->routeIs('admin.reserve-property.list') ? 's-act' : '' }}">
                    Reserve Properties
                </a>
            </li>
            <li class="ic-pay">
                <a href="{{ route('admin.district.index') }}"
                    class="{{ request()->routeIs('admin.district.index') ? 's-act' : '' }}">
                    Districts
                </a>
            </li>

            <li class="ic-pay">
                <a href="{{ route('admin.upazila.index') }}"
                    class="{{ request()->routeIs('admin.upazila.*') ? 's-act' : '' }}">
                    Upazilla
                </a>
            </li>

            <li class="ic-pay">
                <a href="{{ route('admin.what-you-setting.edit') }}"
                    class="{{ request()->routeIs('admin.what-you-setting.edit') ? 's-act' : '' }}">
                    What You Setting
                </a>
            </li>

            <li class="ic-pay">
                <a href="{{ route('admin.what-you-item.index') }}"
                    class="{{ request()->routeIs('admin.what-you-item.*') ? 's-act' : '' }}">
                    WhatYou Items
                </a>
            </li>

            <li>
                <h4>Enquiries</h4>
            </li>
            {{-- <li class="ic-feat">
                <a href="{{ route('admin.enquiry.manage') }}"
                    class="{{ request()->routeIs('admin.enquiry.manage') ? 's-act' : '' }}">Enquiries</a>
            </li>

            <li>
                <h4>CMS</h4>
            </li>

            <li class="ic-medi">
                <a href="javascript:void(0);"
                    class="{{ request()->routeIs('admin.wedding.*') ? 'mact' : '' }}">Weddings & Galleries</a>
                <div>
                    <ol>
                        <li>
                            <a href="{{ route('admin.wedding.add') }}"
                                class="{{ request()->routeIs('admin.wedding.add') ? 's-act' : '' }}">Add New</a>
                        </li>

                        <li>
                            <a href="{{ route('admin.wedding.manage') }}"
                                class="{{ request()->routeIs('admin.wedding.manage') ? 's-act' : '' }}">Manage</a>
                        </li>
                    </ol>
                </div>
            </li>

            <li class="ic-txt">
                <a href="javascript:void(0);" class="{{ request()->routeIs('admin.blog.*') ? 'mact' : '' }}">Blog &
                    Articles</a>
                <div>
                    <ol>
                        <li>
                            <a href="{{ route('admin.blog.add') }}"
                                class="{{ request()->routeIs('admin.blog.add') ? 's-act' : '' }}">Add New</a>
                        </li>

                        <li>
                            <a href="{{ route('admin.blog.manage') }}"
                                class="{{ request()->routeIs('admin.blog.manage') ? 's-act' : '' }}">Manage</a>
                        </li>

                        <li>
                            <a href="{{ route('admin.blog.category.manage') }}"
                                class="{{ request()->routeIs('admin.blog.category.manage') ? 's-act' : '' }}">Categories</a>
                        </li>

                        <li>
                            <a href="{{ route('admin.blog.tag.manage') }}"
                                class="{{ request()->routeIs('admin.blog.tag.manage') ? 's-act' : '' }}">Tags</a>
                        </li>
                    </ol>
                </div>
            </li>

            <li class="ic-act">
                <a href="{{ route('admin.service.manage') }}"
                    class="{{ request()->routeIs('admin.service.manage') ? 's-act' : '' }}">Services</a>
            </li>
            <li class="ic-slid">
                <a href="{{ route('admin.banner.manage') }}"
                    class="{{ request()->routeIs('admin.banner.manage') ? 's-act' : '' }}">Banners</a>
            </li>
            <li class="ic-upd">
                <a href="{{ route('admin.ourteam.manage') }}"
                    class="{{ request()->routeIs('admin.ourteam.manage') ? 's-act' : '' }}">Our Teams</a>
            </li>

            <li class="ic-upd">
                <a href="{{ route('admin.faq.manage') }}"
                    class="{{ request()->routeIs('admin.faq.manage') ? 's-act' : '' }}">FAQ</a>
            </li>

            <li class="ic-febk">
                <a href="{{ route('admin.testimonial.manage') }}"
                    class="{{ request()->routeIs('admin.testimonial.manage') ? 's-act' : '' }}">Testimonials</a>
            </li>

            <li class="ic-inv">
                <a href="{{ route('admin.weddingstep.manage') }}"
                    class="{{ request()->routeIs('admin.weddingstep.manage') ? 's-act' : '' }}">Event Steps</a>
            </li>

            <li>
                <h4>Settings</h4>
            </li>
            <li class="ic-set">
                <a href="{{ route('admin.generalsetting.edit') }}"
                    class="{{ request()->routeIs('admin.generalsetting.edit') ? 's-act' : '' }}">Site Setting</a>
            </li>
            <li class="ic-set">
                <a href="{{ route('admin.contactinfo.edit') }}"
                    class="{{ request()->routeIs('admin.contactinfo.edit') ? 's-act' : '' }}">Contact Infos</a>
            </li>

            <li>
                <h4>Others</h4>
            </li>
            <li class="ic-feat">
                <a href="{{ route('admin.city.manage') }}"
                    class="{{ request()->routeIs('admin.city.manage') ? 's-act' : '' }}">Cities</a>
            </li>
            <li class="ic-feat">
                <a href="{{ route('admin.hobby.manage') }}"
                    class="{{ request()->routeIs('admin.hobby.manage') ? 's-act' : '' }}">Hobbies</a>
            </li> --}}
            <li>
                <h4>Sign out </h4>
            </li>
            <li class="ic-lgo">
                <a href="{{ route('admin.logout') }}">Log out</a>
            </li>
        </ul>
    </div>
</div>

