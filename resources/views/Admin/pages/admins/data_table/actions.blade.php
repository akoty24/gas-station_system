<div class="btn-group manage-button" title="View Account">
    <a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="fa fa-cog"></i> <span class="caret"></span>
    </a>
    <ul role="menu" class="dropdown-menu dropdown-light pull-right">

        @if( $admin->status == 0 )
            <li>
                <a title="{{ trans('backend.activation') }} {{ trans('backend.record') }}" href="{{ route('admin.admins.activation' , $admin->id) }}">
                    <i class="fa fa-fw fa-check"></i> {{ trans('backend.activation') }}
                </a>
            </li>
        @else
            <li>
                <a title="{{ trans('backend.disable') }} {{ trans('backend.record') }}" href="{{ route('admin.admins.activation' , $admin->id) }}">
                    <i class="fa fa-fw fa-close"></i> {{ trans('backend.disable') }}
                </a>
            </li>
        @endif
        

        <li>
            <a title="{{ trans('backend.show') }} {{ trans('backend.record') }}" href="{{ route('admin.admins.show' , $admin->id) }}">
                <i class="fa fa-fw fa-eye"></i> {{ trans('backend.show') }}
            </a>
        </li>
        
        <li>
            <a title="{{ trans('backend.edit') }} {{ trans('backend.record') }}" href="{{ route('admin.admins.edit' , $admin->id) }}">
                <i class="fa fa-fw fa-pencil"></i> {{ trans('backend.edit') }}
            </a>
        </li>
        
        <li>
            <form action="{{ route('admin.admins.destroy' , $admin->id) }}" method="POST" style="display:inline">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button title="{{ trans('backend.edit') }} {{ trans('backend.record') }}" type="submit"  class="delete" style="cursor:pointer">
                    <i class="fa fa-trash fa-fw"></i> {{ trans('backend.delete') }}
                </button>
            </form>
        </li>
    </ul>
</div>