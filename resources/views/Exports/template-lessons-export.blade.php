<table>
    <tbody>

    <tr>
        <td>Понедельник</td>
        @foreach ($templateLessons[1] as $name => $groupLessons)
        <td>{{ $name }}</td>
        <td></td>
        @endforeach
    </tr>

    @for($index = 1; $index < 6; $index++)
    <tr>
        <td>{{ $index }} пара</td>
        @foreach($templateLessons[1] as $name => $groupLessons)
        <td>
            @foreach($groupLessons as $lesson)
            <div>
                @if($lesson->position === $index)
                <div>
                    @if($lesson->week_number === 0)
                    <div>
                        {{ $lesson->subject->index . ' ' . $lesson->subject->name . ' ' . $lesson->subject->teacher }}
                        <br>
                    </div>
                    @elseif($lesson->week_number === 1)
                    <div>
                        1 н: {{ $lesson->subject->index . ' ' . $lesson->subject->name . ' ' . $lesson->subject->teacher }}
                        <br>
                    </div>
                    @elseif($lesson->week_number === 2)
                    <div>
                        2 н: {{ $lesson->subject->index . ' ' . $lesson->subject->name . ' ' . $lesson->subject->teacher }}
                        <br>
                    </div>
                    @endif
                </div>
                @endif
            </div>
            @endforeach
        </td>
        <td>
            @foreach($groupLessons as $lesson)
                @if($lesson->position === $index)
                    <div>
                        {{ $lesson->subject->class }}
                        <br>
                    </div>
                @endif
            @endforeach
        </td>
        @endforeach
    </tr>
    @endfor

    <tr>
        <td>Вторник</td>
        @foreach ($templateLessons[2] as $name => $groupLessons)
            <td>{{ $name }}</td>
            <td></td>
        @endforeach
    </tr>

    @for($index = 1; $index < 6; $index++)
        <tr>
            <td>{{ $index }} пара</td>
            @foreach($templateLessons[2] as $name => $groupLessons)
                <td>
                    @foreach($groupLessons as $lesson)
                        <div>
                            @if($lesson->position === $index)
                                <div>
                                    @if($lesson->week_number === 0)
                                        <div>
                                            {{ $lesson->subject->index . ' ' . $lesson->subject->name . ' ' . $lesson->subject->teacher }}
                                            <br>
                                        </div>
                                    @elseif($lesson->week_number === 1)
                                        <div>
                                            1 н: {{ $lesson->subject->index . ' ' . $lesson->subject->name . ' ' . $lesson->subject->teacher }}
                                            <br>
                                        </div>
                                    @elseif($lesson->week_number === 2)
                                        <div>
                                            2 н: {{ $lesson->subject->index . ' ' . $lesson->subject->name . ' ' . $lesson->subject->teacher }}
                                            <br>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endforeach
                </td>
                <td>
                    @foreach($groupLessons as $lesson)
                        @if($lesson->position === $index)
                            <div>
                                {{ $lesson->subject->class }}
                                <br>
                            </div>
                        @endif
                    @endforeach
                </td>
            @endforeach
        </tr>
    @endfor

    <tr>
        <td>Среда</td>
        @foreach ($templateLessons[3] as $name => $groupLessons)
            <td>{{ $name }}</td>
            <td></td>
        @endforeach
    </tr>

    @for($index = 1; $index < 6; $index++)
        <tr>
            <td>{{ $index }} пара</td>
            @foreach($templateLessons[3] as $name => $groupLessons)
                <td>
                    @foreach($groupLessons as $lesson)
                        <div>
                            @if($lesson->position === $index)
                                <div>
                                    @if($lesson->week_number === 0)
                                        <div>
                                            {{ $lesson->subject->index . ' ' . $lesson->subject->name . ' ' . $lesson->subject->teacher }}
                                            <br>
                                        </div>
                                    @elseif($lesson->week_number === 1)
                                        <div>
                                            1 н: {{ $lesson->subject->index . ' ' . $lesson->subject->name . ' ' . $lesson->subject->teacher }}
                                            <br>
                                        </div>
                                    @elseif($lesson->week_number === 2)
                                        <div>
                                            2 н: {{ $lesson->subject->index . ' ' . $lesson->subject->name . ' ' . $lesson->subject->teacher }}
                                            <br>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endforeach
                </td>
                <td>
                    @foreach($groupLessons as $lesson)
                        @if($lesson->position === $index)
                            <div>
                                {{ $lesson->subject->class }}
                                <br>
                            </div>
                        @endif
                    @endforeach
                </td>
            @endforeach
        </tr>
    @endfor

    <tr>
        <td>Четверг</td>
        @foreach ($templateLessons[4] as $name => $groupLessons)
            <td>{{ $name }}</td>
            <td></td>
        @endforeach
    </tr>

    @for($index = 1; $index < 6; $index++)
        <tr>
            <td>{{ $index }} пара</td>
            @foreach($templateLessons[4] as $name => $groupLessons)
                <td>
                    @foreach($groupLessons as $lesson)
                        <div>
                            @if($lesson->position === $index)
                                <div>
                                    @if($lesson->week_number === 0)
                                        <div>
                                            {{ $lesson->subject->index . ' ' . $lesson->subject->name . ' ' . $lesson->subject->teacher }}
                                            <br>
                                        </div>
                                    @elseif($lesson->week_number === 1)
                                        <div>
                                            1 н: {{ $lesson->subject->index . ' ' . $lesson->subject->name . ' ' . $lesson->subject->teacher }}
                                            <br>
                                        </div>
                                    @elseif($lesson->week_number === 2)
                                        <div>
                                            2 н: {{ $lesson->subject->index . ' ' . $lesson->subject->name . ' ' . $lesson->subject->teacher }}
                                            <br>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endforeach
                </td>
                <td>
                    @foreach($groupLessons as $lesson)
                        @if($lesson->position === $index)
                            <div>
                                {{ $lesson->subject->class }}
                                <br>
                            </div>
                        @endif
                    @endforeach
                </td>
            @endforeach
        </tr>
    @endfor

    <tr>
        <td>Пятница</td>
        @foreach ($templateLessons[5] as $name => $groupLessons)
            <td>{{ $name }}</td>
            <td></td>
        @endforeach
    </tr>

    @for($index = 1; $index < 6; $index++)
        <tr>
            <td>{{ $index }} пара</td>
            @foreach($templateLessons[5] as $name => $groupLessons)
                <td>
                    @foreach($groupLessons as $lesson)
                        <div>
                            @if($lesson->position === $index)
                                <div>
                                    @if($lesson->week_number === 0)
                                        <div>
                                            {{ $lesson->subject->index . ' ' . $lesson->subject->name . ' ' . $lesson->subject->teacher }}
                                            <br>
                                        </div>
                                    @elseif($lesson->week_number === 1)
                                        <div>
                                            1 н: {{ $lesson->subject->index . ' ' . $lesson->subject->name . ' ' . $lesson->subject->teacher }}
                                            <br>
                                        </div>
                                    @elseif($lesson->week_number === 2)
                                        <div>
                                            2 н: {{ $lesson->subject->index . ' ' . $lesson->subject->name . ' ' . $lesson->subject->teacher }}
                                            <br>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endforeach
                </td>
                <td>
                    @foreach($groupLessons as $lesson)
                        @if($lesson->position === $index)
                            <div>
                                {{ $lesson->subject->class }}
                                <br>
                            </div>
                        @endif
                    @endforeach
                </td>
            @endforeach
        </tr>
    @endfor

    </tbody>
</table>
